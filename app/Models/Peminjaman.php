<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    /**
     * Table name (optional, Laravel will pluralize by default).
     */
    protected $table = 'peminjamans';

    /**
     * Mass assignable attributes for create/update calls.
     */
    protected $fillable = [
        'mahasiswa_id',
        'barang_id',
        'tgl_pinjam',
        'tgl_kembali_rencana',
        'tgl_kembali_realisasi',
        'kondisi_pinjam_raw',
        'kondisi_pinjam_clean',
        'is_preprocessed',
        'status',
        'keperluan',
    ];

    /**
     * Cast date/boolean fields to appropriate types.
     */
    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali_rencana' => 'date',
        'tgl_kembali_realisasi' => 'datetime',
        'is_preprocessed' => 'boolean',
    ];

    /**
     * Relationship: peminjaman belongs to a mahasiswa.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    /**
     * Relationship: peminjaman belongs to a barang.
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
