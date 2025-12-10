<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_barangs_table.php

public function up()
{
    Schema::create('barangs', function (Blueprint $table) {
        $table->id(); // Primary Key
        $table->string('kode_barang')->unique(); // Misal: LAB-001
        $table->string('nama_barang');
        $table->string('kategori'); // Elektronik, Gelas, Bahan Kimia
        $table->integer('stok_total');
        $table->integer('stok_tersedia');
        $table->string('lokasi_rak')->nullable(); // Misal: Rak A1
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
