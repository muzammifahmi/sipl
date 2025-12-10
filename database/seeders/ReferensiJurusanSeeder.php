<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferensiJurusanSeeder extends Seeder
{
    public function run()
    {
        $jurusans = [

            // ==========================
            // RUMPUN SAINTEK / STEM
            // ==========================

            // Informatika & Komputer
            'Teknik Informatika',
            'Pendidikan Teknik Informatika',
            'Sistem Informasi',
            'Ilmu Komputer',
            'Rekayasa Perangkat Lunak',
            'Teknologi Informasi',
            'Teknik Komputer',
            'Data Science',
            'Artificial Intelligence',
            'Cyber Security',
            'Teknologi Game',

            // Teknik / Engineering
            'Teknik Elektro',
            'Teknik Mesin',
            'Teknik Industri',
            'Teknik Sipil',
            'Teknik Kimia',
            'Teknik Lingkungan',
            'Teknik Perminyakan',
            'Teknik Perkapalan',
            'Teknik Metalurgi',
            'Teknik Geomatika',
            'Teknik Geodesi',
            'Teknik Fisika',
            'Teknik Material',
            'Teknik Penerbangan',
            'Teknik Transportasi',
            'Teknik Telekomunikasi',
            'Teknik Biomedik',
            'Teknik Nuklir',
            'Teknik Otomotif',
            'Teknik Biosistem',

            // Arsitektur & Desain
            'Arsitektur',
            'Desain Komunikasi Visual',
            'Desain Produk',
            'Desain Interior',
            'Arsitektur Lanskap',
            'Perencanaan Wilayah dan Kota',

            // Sains dan Matematika
            'Matematika',
            'Statistika',
            'Fisika',
            'Kimia',
            'Biologi',
            'Geografi',
            'Geologi',
            'Astronomi',
            'Data Science & Analytics',

            // Pertanian & Perikanan
            'Agribisnis',
            'Agroteknologi',
            'Ilmu Kelautan',
            'Perikanan',
            'Peternakan',
            'Kehutanan',
            'Teknologi Hasil Pertanian',
            'Teknologi Pangan',
            'Proteksi Tanaman',
            'Teknologi Produksi Ternak',

            // Kedokteran & Kesehatan
            'Kedokteran',
            'Kedokteran Gigi',
            'Kedokteran Hewan',
            'Farmasi',
            'Keperawatan',
            'Kesehatan Masyarakat',
            'Gizi',
            'Fisioterapi',
            'Radiologi',
            'Rekam Medis',
            'Kebidanan',
            'Analis Kesehatan / Teknologi Laboratorium Medik',

            // ==========================
            // RUMPUN SOSHUM
            // ==========================

            // Ekonomi & Bisnis
            'Akuntansi',
            'Manajemen',
            'Ekonomi Pembangunan',
            'Ekonomi Syariah',
            'Bisnis Digital',
            'Administrasi Bisnis',
            'Perbankan Syariah',
            'Perpajakan',

            // Hukum, Politik & Sosial
            'Ilmu Hukum',
            'Ilmu Pemerintahan',
            'Administrasi Publik',
            'Hubungan Internasional',
            'Sosiologi',
            'Ilmu Komunikasi',
            'Kriminologi',
            'Antropologi',
            'Politik dan Pemerintahan',
            'Kebijakan Publik',

            // Psikologi
            'Psikologi',

            // Pendidikan (Keguruan)
            'PGSD',
            'PGPAUD',
            'Pendidikan Matematika',
            'Pendidikan Fisika',
            'Pendidikan Kimia',
            'Pendidikan Biologi',
            'Pendidikan Bahasa Inggris',
            'Pendidikan Bahasa Indonesia',
            'Pendidikan Agama Islam',
            'Pendidikan IPS',
            'Pendidikan Pancasila dan Kewarganegaraan',
            'Pendidikan Seni Rupa',
            'Pendidikan Teknik Mesin',
            'Pendidikan Teknik Elektro',
            'Pendidikan Tata Busana',
            'Pendidikan Tata Boga',
            'Pendidikan Olahraga',
            'Bimbingan dan Konseling',
            'Manajemen Pendidikan',

            // Bahasa & Sastra
            'Sastra Inggris',
            'Sastra Indonesia',
            'Sastra Arab',
            'Sastra Jepang',
            'Sastra Cina',
            'Bahasa Korea',
            'Bahasa Mandarin',
            'Linguistik',

            // Seni & Media
            'Seni Musik',
            'Seni Tari',
            'Film dan Televisi',
            'Animasi',
            'Fotografi',

            // Pariwisata
            'Pariwisata',
            'Hospitality Management',
            'Perhotelan',
            'Manajemen Event',
        ];

        foreach ($jurusans as $j) {
            DB::table('referensi_jurusans')->insert([
                'nama_jurusan' => $j,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
