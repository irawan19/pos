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
        Schema::create('master_konfigurasi_aplikasis', function (Blueprint $table) {
            $table->increments('id_konfigurasi_aplikasis');
            $table->string('nama_konfigurasi_aplikasis');
            $table->longtext('deskripsi_konfigurasi_aplikasis');
            $table->longtext('keywords_konfigurasi_aplikasis');
            $table->string('icon_konfigurasi_aplikasis');
            $table->string('logo_konfigurasi_aplikasis');
            $table->string('logo_text_konfigurasi_aplikasis');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_konfigurasi_aplikasis');
    }
};
