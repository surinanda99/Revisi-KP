<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori_bidang', ['Web Development', 'Application Development', 'Game Development', 'Data Analysis', 'Data Science', 'Artificial Intelligence', 'Graphic Design', 'Networking']);
            $table->string('judul');
            $table->string('perusahaan');
            $table->string('posisi');
            $table->text('deskripsi');
            $table->string('durasi');
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
