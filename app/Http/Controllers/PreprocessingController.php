<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class PreprocessingController extends Controller
{
    /**
     * Menampilkan halaman Data Mentah
     */
    public function indexRaw()
    {
        // Ambil data Mahasiswa dari database
        $rawData = Mahasiswa::select(['nim', 'nama', 'jurusan_raw', 'jurusan_clean', 'angkatan', 'email'])->get();

        // Kirim koleksi (Eloquent Collection) ke view sebagai `rawData`
        return view('preprocessing.raw', compact('rawData'));
    }

    /**
     * Menampilkan halaman Data Bersih
     */
    public function indexClean()
    {
        // Ambil data mahasiswa yang sudah memiliki jurusan_clean
        $cleanData = Mahasiswa::whereNotNull('jurusan_clean')
            ->select(['nim', 'nama', 'jurusan_clean', 'angkatan', 'email'])
            ->orderBy('nama')
            ->get();

        // Kirim koleksi ke view sebagai `cleanData`
        return view('preprocessing.clean', compact('cleanData'));
    }

    /**
     * Import data mahasiswa dari file Excel/CSV
     */
    public function import(Request $request)
    {
        try {
            // Validasi file
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:xlsx,xls,csv|max:10240', // max 10MB
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak valid: ' . $validator->errors()->first()
                ]);
            }

            $file = $request->file('file');
            $data = Excel::toArray([], $file)[0]; // Ambil sheet pertama

            if (empty($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak berisi data'
                ]);
            }

            // Ambil header dari baris pertama
            $header = array_shift($data);
            $header = array_map('strtolower', array_map('trim', $header));

            // Cari indeks kolom yang diperlukan
            $nimIndex = array_search('nim', $header);
            $namaIndex = array_search('nama', $header);
            $jurusanIndex = array_search('jurusan', $header);
            $angkatanIndex = array_search('angkatan', $header);
            $emailIndex = array_search('email', $header);

            if ($nimIndex === false || $namaIndex === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'File harus memiliki kolom NIM dan Nama'
                ]);
            }

            $imported = 0;
            $skipped = 0;
            $errors = [];

            foreach ($data as $rowIndex => $row) {
                try {
                    $nim = trim($row[$nimIndex] ?? '');
                    $nama = trim($row[$namaIndex] ?? '');
                    $jurusan = trim($row[$jurusanIndex] ?? '');
                    $angkatan = trim($row[$angkatanIndex] ?? '');
                    $email = trim($row[$emailIndex] ?? '');

                    // Skip jika NIM atau Nama kosong
                    if (empty($nim) || empty($nama)) {
                        $skipped++;
                        continue;
                    }

                    // Cek apakah mahasiswa sudah ada
                    $existingMahasiswa = Mahasiswa::where('nim', $nim)->first();

                    if ($existingMahasiswa) {
                        // Update data yang ada
                        $existingMahasiswa->update([
                            'nama' => $nama,
                            'jurusan_raw' => $jurusan,
                            'angkatan' => $angkatan,
                            'email' => $email,
                        ]);
                    } else {
                        // Buat data baru
                        Mahasiswa::create([
                            'nim' => $nim,
                            'nama' => $nama,
                            'jurusan_raw' => $jurusan,
                            'angkatan' => $angkatan,
                            'email' => $email,
                        ]);
                    }

                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Baris " . ($rowIndex + 2) . ": " . $e->getMessage();
                    $skipped++;
                }
            }

            $message = "Import selesai. {$imported} data berhasil diimport.";
            if ($skipped > 0) {
                $message .= " {$skipped} data dilewati.";
            }
            if (!empty($errors)) {
                $message .= " Error: " . implode('; ', array_slice($errors, 0, 3));
                if (count($errors) > 3) {
                    $message .= " (dan " . (count($errors) - 3) . " error lainnya)";
                }
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'imported' => $imported,
                'skipped' => $skipped
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
