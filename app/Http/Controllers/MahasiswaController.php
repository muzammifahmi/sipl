<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ReferensiJurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
// MahasiswaController.php
public function update(Request $request, Mahasiswa $mahasiswa)
{
    $validated = $request->validate([
        'nim' => 'required|string|max:20',
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'angkatan' => 'required|integer|min:2000|max:2030',
        'jurusan_raw' => 'required|string|max:255',
    ]);

    // Check if jurusan_raw was changed
    $jurusanChanged = $mahasiswa->jurusan_raw !== $validated['jurusan_raw'];

    // Reset jurusan_clean if jurusan_raw was changed
    if ($jurusanChanged) {
        $validated['jurusan_clean'] = null;
    }

    $mahasiswa->update($validated);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diperbarui.',
            'jurusan_changed' => $jurusanChanged
        ]);
    }

    // Set session message based on whether jurusan was changed
    if ($jurusanChanged) {
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.')
            ->with('need_reprocess', 'Jurusan telah diubah. Jalankan preprocessing untuk memperbarui jurusan_clean.');
    }

    return redirect()->route('mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan mahasiswa berdasarkan id
        $mhs = Mahasiswa::find($id);

        if (!$mhs) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        try {
            // Hapus peminjaman terkait terlebih dahulu (jika belum dikonfigurasi cascade)
            $mhs->peminjamans()->delete();

            // Hapus mahasiswa
            $mhs->delete();

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            // Log error jika diperlukan (tidak menampilkan stacktrace ke user)
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

public function raw()
{
    $mahasiswas = Mahasiswa::orderBy('nama')
        ->paginate(20);

    return view('mahasiswa.raw', compact('mahasiswas'));
}

public function clean()
{
    $mahasiswas = Mahasiswa::whereNotNull('jurusan_clean')
        ->orderBy('nama')
        ->paginate(20);

    return view('mahasiswa.clean', compact('mahasiswas'));
}


public function preprocess()
{
    // Ambil referensi jurusan dari database
    $standardMajors = ReferensiJurusan::pluck('nama_jurusan')->toArray();

    // Ambil semua data mahasiswa
    $mahasiswas = Mahasiswa::all();

    $count = 0;

    foreach ($mahasiswas as $mhs) {

        // Lewati jika sudah bersih
        if (!empty($mhs->jurusan_clean)) {
            continue;
        }

        // Normalisasi input raw
        $raw = trim(strtolower($mhs->jurusan_raw ?? ''));

        // Jika kosong, lewati
        if ($raw === '') {
            $mhs->jurusan_clean = null;
            $mhs->save();
            continue;
        }

        $bestMatch = null;
        $highestScore = 0;

        foreach ($standardMajors as $standard) {

            $standardLower = strtolower($standard);
            $score = 0;

            // 1. Exact match
            if ($standardLower === $raw) {
                $score = 100;

            } else {

                // 2. INITIAL MATCH → "ti" = "Teknik Informatika"
                $initials = implode('', array_map(fn($w) => $w[0], explode(' ', $standardLower)));

                if ($initials === $raw) {
                    $score = 97;

                // 3. Prefix match → raw di awal jurusan
                } elseif (strpos($standardLower, $raw) === 0) {
                    $score = 95;

                } else {

                    // 4. Word-by-word match
                    foreach (explode(' ', $standardLower) as $word) {

                        // Exact match kata
                        if ($word === $raw) {
                            $score = 90;
                            break;

                        // Raw sebagai prefix kata
                        } elseif (strpos($word, $raw) === 0) {
                            $score = max($score, 85);
                        }
                    }

                    // 5. Fallback — similar_text
                    if ($score === 0) {
                        similar_text($raw, $standardLower, $percent);
                        $score = $percent;
                    }
                }
            }

            // Simpan score tertinggi
            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $standard;
            }
        }

        // Tentukan hasil akhir
        if ($highestScore >= 40 && $bestMatch) {
            $clean = $bestMatch;
        } else {
            // Default: kapitalisasi per kata
            $clean = ucwords($raw);
        }

        // Simpan jika berubah
        if ($mhs->jurusan_clean !== $clean) {
            $mhs->jurusan_clean = $clean;
            $mhs->save();
            $count++;
        }
    }

    return back()->with('success', "Preprocessing selesai! $count data berhasil dipetakan.");
}

}
