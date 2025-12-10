<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiJurusan extends Model
{
    use HasFactory;

    protected $table = 'referensi_jurusans';
    protected $fillable = ['nama_jurusan'];
}
