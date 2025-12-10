<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

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
}
