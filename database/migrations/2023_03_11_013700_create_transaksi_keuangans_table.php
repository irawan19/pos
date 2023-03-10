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
        Schema::create('transaksi_keuangans', function (Blueprint $table) {
            $table->increments('id_keuangans');
            $table->integer('tokos_id')->unsigned()->index()->nullable();
            $table->foreign('tokos_id')->references('id_tokos')->on('master_tokos')->onUpdate('set null')->onDelete('set null');
            $table->unsignedBigInteger('users_id')->index()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->string('no_keuangans');
            $table->string('nama_keuangans');
            $table->double('jumlah_keuangans');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_keuangans');
    }
};
