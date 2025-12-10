<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_mahasiswas_table.php

    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nim')->unique(); // Identitas Unik
            $table->string('nama');

            // --- KOLOM PREPROCESSING ---
            // Input user: "Teknik Informatika", "TI", "Informatika" (Berantakan)
            $table->string('jurusan_raw')->nullable();
            // Hasil sistem: "Teknik Informatika" (Seragam)
            $table->string('jurusan_clean')->nullable();

            $table->string('angkatan', 4);
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
