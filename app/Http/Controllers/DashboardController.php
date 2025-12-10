<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Total units (sum of stok_total)
        $totalUnits = (int) Barang::sum('stok_total');

        // Currently dipinjam
        $currentlyBorrowed = Peminjaman::where('status', 'Dipinjam')->count();

        // Terlambat: dipinjam and planned return date before today
        $today = Carbon::today();
        $terlambat = Peminjaman::where('status', 'Dipinjam')
            ->whereDate('tgl_kembali_rencana', '<', $today)
            ->count();

        // Mahasiswa count
        $mahasiswaCount = Mahasiswa::count();

        // Kondisi baik: compute available / total as percentage
        $totalAvailable = (int) Barang::sum('stok_tersedia');
        $kondisiBaikPct = $totalUnits > 0 ? round(($totalAvailable / $totalUnits) * 100, 1) : 0;

        // Recent peminjaman (latest by tgl_pinjam)
        $recent = Peminjaman::with(['mahasiswa', 'barang'])
            ->orderByDesc('tgl_pinjam')
            ->limit(5)
            ->get();

        // Weekly stats: counts per day for last 7 days
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $d = Carbon::today()->subDays($i);
            $count = Peminjaman::whereDate('tgl_pinjam', $d)->count();
            $days->push(['label' => $d->format('D'), 'count' => $count]);
        }

        return view('dashboard', compact(
            'totalUnits',
            'currentlyBorrowed',
            'terlambat',
            'mahasiswaCount',
            'kondisiBaikPct',
            'recent',
            'days'
        ));
    }
}
