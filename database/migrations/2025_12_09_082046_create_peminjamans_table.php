<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_peminjamans_table.php

public function up()
{
    Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();

        // --- RELASI (FOREIGN KEYS) ---
        // Menghubungkan ke tabel mahasiswas
        $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
        // Menghubungkan ke tabel barangs
        $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');

        $table->date('tgl_pinjam');
        $table->date('tgl_kembali_rencana');
        $table->date('tgl_kembali_realisasi')->nullable();

        // --- KOLOM PREPROCESSING ---
        // Input: "lecet dikit", "baret halus", "agak kotor"
        $table->string('kondisi_pinjam_raw')->nullable();
        // Hasil: "Rusak Ringan"
        $table->string('kondisi_pinjam_clean')->nullable();

        // Status Preprocessing: 0 = Belum diproses, 1 = Sudah bersih
        $table->boolean('is_preprocessed')->default(false);

        $table->enum('status', ['Dipinjam', 'Kembali', 'Terlambat'])->default('Dipinjam');
        $table->text('keperluan')->nullable(); // Alasan pinjam

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
