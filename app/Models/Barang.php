<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'stok_total',
        'stok_tersedia',
        'lokasi_rak',
    ];
    public function peminjamans()
{
    return $this->hasMany(Peminjaman::class);
}
}
