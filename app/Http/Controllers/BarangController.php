<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::latest()->paginate(10);
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // app/Http/Controllers/BarangController.php

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barangs|max:20',
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'stok_total'  => 'required|integer|min:1',
            'lokasi_rak'  => 'nullable|string|max:50',
        ]);

        // 2. Logika Bisnis: Stok Tersedia awal = Stok Total
        $validated['stok_tersedia'] = $validated['stok_total'];

        // 3. Simpan ke Database
        Barang::create($validated);

        // 4. Redirect ke Index dengan pesan sukses
        return redirect()->route('barang.index')
            ->with('success', 'Alat baru berhasil ditambahkan ke inventaris!');
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
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        // 1. Validasi
        $validated = $request->validate([
            // PENTING: 'unique:barangs,kode_barang,' . $barang->id
            // Artinya: Cek unik kode_barang, TAPI abaikan untuk ID barang yang sedang diedit ini.
            'kode_barang' => 'required|max:20|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string',
            // Stok total baru tidak boleh lebih kecil dari jumlah yang sedang dipinjam (stok_total lama - stok_tersedia lama)
            'stok_total'  => 'required|integer|min:' . ($barang->stok_total - $barang->stok_tersedia),
            'lokasi_rak'  => 'nullable|string|max:50',
        ], [
            'stok_total.min' => 'Stok total tidak boleh kurang dari jumlah barang yang sedang dipinjam (' . ($barang->stok_total - $barang->stok_tersedia) . ' unit).'
        ]);

        // 2. Logika Perhitungan Stok
        // Hitung selisih stok baru dengan stok lama
        $selisihStok = $validated['stok_total'] - $barang->stok_total;

        // Update stok tersedia berdasarkan selisih tersebut
        // Jika selisih positif (nambah stok), stok tersedia bertambah
        // Jika selisih negatif (kurang stok), stok tersedia berkurang
        $validated['stok_tersedia'] = $barang->stok_tersedia + $selisihStok;

        // 3. Update Database
        $barang->update($validated);

        // 4. Redirect
        return redirect()->route('barang.index')
            ->with('success', 'Data alat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
// Di BarangController.php
public function destroy(Barang $barang)
{
    try {
        // Simpan informasi untuk pesan
        $namaBarang = $barang->nama_barang;
        $kodeBarang = $barang->kode_barang;

        // Cek apakah ada peminjaman aktif
        $peminjamanAktif = $barang->peminjamans()
            ->where('status', 'Dipinjam')
            ->count();

        if ($peminjamanAktif > 0) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => "Tidak bisa menghapus! Ada $peminjamanAktif peminjaman aktif untuk alat ini."
                ], 422);
            }
            return back()->with('error', "Tidak bisa menghapus! Ada $peminjamanAktif peminjaman aktif untuk alat ini.");
        }

        // Hapus barang
        $barang->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Alat '$namaBarang' ($kodeBarang) berhasil dihapus!"
            ]);
        }

        return redirect()->route('barang.index')
            ->with('success', "Alat '$namaBarang' ($kodeBarang) berhasil dihapus!");

    } catch (\Exception $e) {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus alat: ' . $e->getMessage()
            ], 500);
        }

        return back()->with('error', 'Gagal menghapus alat: ' . $e->getMessage());
    }
}
}
