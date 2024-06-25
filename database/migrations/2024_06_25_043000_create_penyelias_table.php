<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('penyelias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('posisi');
            $table->string('departemen');
            $table->string('perusahaan');
            $table->text('deskripsi_pekerjaan')->nullable();
            $table->text('prestasi_kontribusi')->nullable();
            $table->text('keterampilan_kemampuan')->nullable();
            $table->text('kerjasama_keterlibatan')->nullable();
            $table->text('komentar')->nullable();
            $table->text('perkembangan')->nullable();
            $table->text('kesimpulan_saran')->nullable();
            $table->integer('score')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyelias');
    }
};
