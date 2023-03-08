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
        Schema::create('master_pembayarans', function (Blueprint $table) {
            $table->increments('id_pembayarans');
            $table->string('nama_pembayarans');
            $table->string('akun_pembayarans');
            $table->string('no_rekening_pembayarans');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_pembayarans');
    }
};
