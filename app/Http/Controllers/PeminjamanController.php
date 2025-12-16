<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan Riwayat Transaksi
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['mahasiswa', 'barang'])
            ->latest('tgl_pinjam')
            ->paginate(10);

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Form Input Peminjaman Baru
     */
    public function create()
    {
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();
        return view('peminjaman.create', compact('barangs'));
    }

    /**
     * Menyimpan Data Peminjaman Baru
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            // Validasi Mahasiswa
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'jurusan_raw' => 'required|string',
            'angkatan' => 'required|numeric',
            'email' => 'required|email',

            // Validasi Barang
            'barang_id' => 'required|exists:barangs,id',
            'kondisi_pinjam_raw' => 'required|string',

            // Validasi Peminjaman
            'tgl_pinjam' => 'required|date',
            'tgl_kembali_rencana' => 'required|date|after_or_equal:tgl_pinjam',
            'keperluan' => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // A. HANDLE MAHASISWA
                $mahasiswa = Mahasiswa::updateOrCreate(
                    ['nim' => $request->nim],
                    [
                        'nama' => $request->nama,
                        'jurusan_raw' => $request->jurusan_raw,
                        'angkatan' => $request->angkatan,
                        'email' => $request->email,
                    ]
                );

                // B. HANDLE BARANG
                $barang = Barang::findOrFail($request->barang_id);

                // Cek Stok
                if ($barang->stok_tersedia < 1) {
                    throw new \Exception("Stok barang habis, tidak bisa dipinjam.");
                }

                // Kurangi Stok
                $barang->decrement('stok_tersedia');

                // C. HANDLE PEMINJAMAN
                Peminjaman::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'barang_id' => $barang->id,
                    'tgl_pinjam' => $request->tgl_pinjam,
                    'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
                    'kondisi_pinjam' => $request->kondisi_pinjam_raw, // Sesuaikan dengan field di database
                    'keperluan' => $request->keperluan,
                    'status' => 'Dipinjam',
                    'is_preprocessed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });

            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil disimpan!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Fitur Pengembalian Barang
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        // Validasi untuk pengembalian
        if ($request->status == 'Kembali' && $peminjaman->status != 'Kembali') {
            $request->validate([
                'kondisi_kembali' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat,Hilang',
                'catatan' => 'nullable|string|max:500',
            ]);

            try {
                DB::transaction(function () use ($peminjaman, $request) {
                    // 1. Update status peminjaman
                    $peminjaman->update([
                        'status' => 'Kembali',
                        'tgl_kembali_realisasi' => now(),
                        'kondisi_kembali' => $request->kondisi_kembali,
                        'catatan' => $request->catatan,
                        'updated_at' => now(),
                    ]);

                    // 2. Kembalikan Stok Barang
                    $peminjaman->barang->increment('stok_tersedia');
                });

                return back()->with('success', 'Barang berhasil dikembalikan & stok dipulihkan.');

            } catch (\Exception $e) {
                return back()->with('error', 'Gagal mengembalikan barang: ' . $e->getMessage());
            }
        }

        return back()->with('warning', 'Tidak ada perubahan status.');
    }

    /**
     * Fungsi Pengembalian dengan SweetAlert (AJAX)
     */
    public function kembali(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat,Hilang',
            'catatan' => 'nullable|string|max:500',
        ]);

        if ($peminjaman->status == 'Kembali') {
            return response()->json(['success' => false, 'message' => 'Barang sudah dikembalikan sebelumnya.']);
        }

        try {
            DB::transaction(function () use ($peminjaman, $request) {
                // 1. Update status peminjaman
                $peminjaman->update([
                    'status' => 'Kembali',
                    'tgl_kembali_realisasi' => now(),
                    'kondisi_kembali' => $request->kondisi,
                    'catatan' => $request->catatan,
                    'updated_at' => now(),
                ]);

                // 2. Kembalikan Stok Barang
                $peminjaman->barang->increment('stok_tersedia');
            });

            return response()->json(['success' => true, 'message' => 'Barang berhasil dikembalikan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Hapus Data Peminjaman
     */
    public function destroy(Peminjaman $peminjaman)
    {
        try {
            // Jika status masih 'Dipinjam', kembalikan stok terlebih dahulu
            if ($peminjaman->status == 'Dipinjam') {
                $peminjaman->barang->increment('stok_tersedia');
            }

            $peminjaman->delete();

            return back()->with('success', 'Data transaksi berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * API untuk mencari mahasiswa berdasarkan NIM
     */
    public function searchMahasiswa(Request $request)
    {
        $nim = $request->query('nim');
        if (!$nim) {
            return response()->json(['error' => 'NIM diperlukan'], 400);
        }

        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if ($mahasiswa) {
            return response()->json([
                'found' => true,
                'data' => [
                    'nama' => $mahasiswa->nama,
                    'jurusan_raw' => $mahasiswa->jurusan_raw,
                    'angkatan' => $mahasiswa->angkatan,
                    'email' => $mahasiswa->email,
                ]
            ]);
        } else {
            return response()->json(['found' => false]);
        }
    }

    /**
     * Menampilkan detail peminjaman
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['mahasiswa', 'barang']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Edit data peminjaman (untuk admin)
     */
    public function edit(Peminjaman $peminjaman)
    {
        $barangs = Barang::all();
        $peminjaman->load(['mahasiswa', 'barang']);

        return view('peminjaman.edit', compact('peminjaman', 'barangs'));
    }
}
