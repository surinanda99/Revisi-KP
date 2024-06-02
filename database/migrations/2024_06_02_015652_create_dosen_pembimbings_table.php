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
            $table->string('nidn');
            $table->string('nama');
            $table->integer('sisa_kuota');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pembimbings');
    }
}
