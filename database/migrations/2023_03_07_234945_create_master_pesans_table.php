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
        Schema::create('master_pesans', function (Blueprint $table) {
            $table->id('nama_pesans');
            $table->string('email_pesans');
            $table->string('telepon_pesans');
            $table->string('konten_pesans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_pesans');
    }
};
