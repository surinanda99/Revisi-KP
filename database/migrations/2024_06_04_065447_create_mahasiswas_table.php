<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //  public function up(): void
    //  {
    //      Schema::create('pengajuan', function (Blueprint $table) {
    //          $table->id();
    //          $table->unsignedBigInteger('id_mhs');
    //          $table->unsignedBigInteger('id_dsn');
    //          $table->enum('kategori_bidang', ['Web_Development', 'Application_Development', 'Game_Development', 'Data_Analysis', 'Artificial_Intelligence']);
    //          $table->string('judul')->nullable();
    //          $table->string('perusahaan');
    //          $table->string('posisi');
    //          $table->longText('deskripsi')->nullable();
    //          $table->string('durasi');
    //          $table->enum('status', ['ACC', 'TOLAK', 'PENDING'])->default('PENDING');
    //          $table->longText('alasan')->nullable();
    //          $table->timestamps();
 
    //          $table->foreign('id_mhs')->references('id')->on('mahasiswa')->cascadeOnDelete();
    //          $table->foreign('id_dsn')->references('id')->on('dosen')->cascadeOnDelete();
    //      });
    //  }
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('email');
            $table->double('ipk')->nullable();
            $table->string('telp')->nullable();
            $table->longText('transkrip')->nullable();
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
