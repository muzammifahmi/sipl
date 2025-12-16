<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Export peminjaman data as CSV.
     *
     * For now this supports CSV only. Call with `/reports/export`.
     */
    public function export(Request $request)
    {
        $format = $request->query('format', 'csv');
        if ($format !== 'csv') {
            return redirect()->back()->with('error', 'Format tidak didukung. Gunakan CSV.');
        }

        $fileName = 'laporan_peminjaman_'.date('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $columns = ['Nama Mahasiswa', 'NIM', 'Barang', 'Status', 'Tgl Pinjam', 'Tgl Kembali Rencana', 'Keperluan'];

        $callback = function () use ($columns) {
            $out = fopen('php://output', 'w');

            // BOM for Excel compatibility with UTF-8
            fputs($out, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, $columns);

            Peminjaman::with(['mahasiswa', 'barang'])->chunk(200, function ($rows) use ($out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $r->mahasiswa->nama ?? '',
                        $r->mahasiswa->nim ?? '',
                        $r->barang->nama_barang ?? '',
                        $r->status ?? '',
                        $r->tgl_pinjam ? $r->tgl_pinjam->toDateString() : '',
                        $r->tgl_kembali_rencana ? $r->tgl_kembali_rencana->toDateString() : '',
                        $r->keperluan ?? '',
                    ]);
                }
            });

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}
