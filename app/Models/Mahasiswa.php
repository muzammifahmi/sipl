<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel (Opsional, tapi bagus untuk memastikan)
     */
    protected $table = 'mahasiswas';

    /**
     * Atribut yang boleh diisi secara massal (Mass Assignable).
     * PENTING: Sesuaikan dengan nama kolom di Migration database.
     */
    protected $fillable = [
        'nim',
        'nama',
        'jurusan_raw',   // Ganti 'jurusan' dengan ini (Input user)
        'jurusan_clean', // Tambahkan ini (Hasil Preprocessing nanti)
        'angkatan',
        'email',
    ];

    /**
     * Relasi: Satu Mahasiswa bisa memiliki banyak Peminjaman.
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
