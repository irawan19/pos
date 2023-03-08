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
        Schema::create('transaksi_pembelian_details', function (Blueprint $table) {
            $table->increments('id_transaksi_pembelian_details');
            $table->integer('pembelians_id')->unsigned()->index()->nullable();
            $table->foreign('pembelians_id')->references('id_pembelians')->on('transaksi_pembelians')->onUpdate('set null')->onDelete('set null');
            $table->integer('items_id')->unsigned()->index()->nullable();
            $table->foreign('items_id')->references('id_items')->on('master_items')->onUpdate('set null')->onDelete('set null');
            $table->double('jumlah_pembelian_details');
            $table->double('harga_pembelian_details');
            $table->double('total_pembelian_details');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pembelian_details');
    }
};
