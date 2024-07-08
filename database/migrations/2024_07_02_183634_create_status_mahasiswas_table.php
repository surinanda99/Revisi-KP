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
        Schema::create('status_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mhs');
            $table->unsignedBigInteger('id_dsn')->default(0);
            $table->tinyInteger('pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_mahasiswas');
    }
};
