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
        Schema::create('transaksi_penjualan_details', function (Blueprint $table) {
            $table->increments('id_transaksi_penjualan_details');
            $table->integer('penjualans_id')->unsigned()->index()->nullable();
            $table->foreign('penjualans_id')->references('id_penjualans')->on('transaksi_penjualans')->onUpdate('set null')->onDelete('set null');
            $table->integer('items_id')->unsigned()->index()->nullable();
            $table->foreign('items_id')->references('id_items')->on('master_items')->onUpdate('set null')->onDelete('set null');
            $table->double('jumlah_penjualan_details');
            $table->double('harga_penjualan_details');
            $table->double('total_penjualan_details');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualan_details');
    }
};
