<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Penting untuk transaksi database

class PeminjamanController extends Controller
{
    /**
     * Menampilkan Riwayat Transaksi (Tabel 3)
     */
    public function index()
    {
        // Eager loading 'mahasiswa' dan 'barang' agar query ringan
        // Paginate sehingga view menerima Eloquent models (bukan array/stdClass)
        $peminjamans = Peminjaman::with(['mahasiswa', 'barang'])
            ->latest('tgl_pinjam')
            ->paginate(10);

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Menyimpan Data dari Form Input (Logic Inti Akuisisi Data)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            // Validasi Mahasiswa
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'jurusan_raw' => 'required|string', // Raw data untuk preprocessing
            'angkatan' => 'required|numeric',
            'email' => 'required|email',

            // Validasi Barang
            'barang_id' => 'required|exists:barangs,id',
            'kondisi_pinjam_raw' => 'required|string', // Raw data

            // Validasi Peminjaman
            'tgl_pinjam' => 'required|date',
            'tgl_kembali_rencana' => 'required|date|after_or_equal:tgl_pinjam',
            'keperluan' => 'required|string',
        ]);

        try {
            // Gunakan Transaksi DB: Semua sukses atau tidak sama sekali
            DB::transaction(function () use ($request) {

                // A. HANDLE MAHASISWA (Tabel 1)
                // Cek apakah NIM sudah ada? Jika ada update, jika belum buat baru.
                $mahasiswa = Mahasiswa::updateOrCreate(
                    ['nim' => $request->nim], // Kunci pencarian
                    [
                        'nama' => $request->nama,
                        'jurusan_raw' => $request->jurusan_raw, // Simpan input mentah user
                        'angkatan' => $request->angkatan,
                        'email' => $request->email,
                    ]
                );

                // B. HANDLE BARANG (Tabel 2)
                $barang = Barang::findOrFail($request->barang_id);

                // Cek Stok
                if ($barang->stok_tersedia < 1) {
                    throw new \Exception("Stok barang habis, tidak bisa dipinjam.");
                }

                // Kurangi Stok
                $barang->decrement('stok_tersedia');

                // C. HANDLE PEMINJAMAN (Tabel 3 - Transaksi)
                Peminjaman::create([
                    'mahasiswa_id' => $mahasiswa->id, // Ambil ID dari proses A
                    'barang_id' => $barang->id,       // Ambil ID dari input
                    'tgl_pinjam' => $request->tgl_pinjam,
                    'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
                    'kondisi_pinjam_raw' => $request->kondisi_pinjam_raw, // Simpan input mentah
                    'keperluan' => $request->keperluan,
                    'status' => 'Dipinjam',
                    'is_preprocessed' => false, // Default belum dipreprocess
                ]);
            });

            return redirect()->route('peminjaman.index')
                ->with('success', 'Data Peminjaman berhasil diakuisisi (3 Tabel Terupdate).');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Fitur Pengembalian Barang (Update Status & Stok)
     */
    public function create()
    {
        // Ambil data barang untuk dropdown peminjaman
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();

        return view('peminjaman.create', compact('barangs'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        // Jika status diubah menjadi 'Kembali'
        if ($request->status == 'Kembali' && $peminjaman->status != 'Kembali') {
            DB::transaction(function () use ($peminjaman) {
                // 1. Update status peminjaman
                $peminjaman->update([
                    'status' => 'Kembali',
                    'tgl_kembali_realisasi' => now(),
                ]);

                // 2. Kembalikan Stok Barang
                $peminjaman->barang->increment('stok_tersedia');
            });
        }

        return back()->with('success', 'Barang berhasil dikembalikan & stok dipulihkan.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Opsional: Hapus data (biasanya peminjaman jarang dihapus fisik, hanya ubah status)
        $peminjaman->delete();
        return back()->with('success', 'Data transaksi dihapus.');
    }
}
