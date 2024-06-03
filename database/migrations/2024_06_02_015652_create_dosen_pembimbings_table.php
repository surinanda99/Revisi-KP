<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPembimbingsTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pembimbings', function (Blueprint $table) {
            $table->id();
            $table->string('npp');
            $table->string('nama');
            $table->enum('bidang_kajian', ['RPLD', 'SC']);
            $table->integer('kuota');
            $table->integer('jumlah_ajuan');
            $table->integer('ajuan_diterima');
            $table->integer('sisa_kuota');
            $table->enum('status', ['Penuh', 'Tersedia']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pembimbings');
    }
}
