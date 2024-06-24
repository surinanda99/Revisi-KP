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
        Schema::create('detail_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_penyelia_id')->constrained('profil_penyelia')->onDelete('cascade');
            $table->text('deskripsi_pekerjaan');
            $table->text('prestasi_kontribusi');
            $table->text('keterampilan_kemampuan');
            $table->text('kerjasama_keterlibatan');
            $table->text('komentar')->nullable();
            $table->text('perkembangan');
            $table->text('kesimpulan_saran')->nullable();
            $table->integer('score');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penilaian');
    }
};
