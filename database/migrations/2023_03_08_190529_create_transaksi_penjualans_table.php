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
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->increments('id_penjualans');
            $table->integer('tokos_id')->unsigned()->index()->nullable();
            $table->foreign('tokos_id')->references('id_tokos')->on('master_tokos')->onUpdate('set null')->onDelete('set null');
            $table->integer('customers_id')->unsigned()->index()->nullable();
            $table->foreign('customers_id')->references('id_customers')->on('master_customers')->onUpdate('set null')->onDelete('set null');
            $table->integer('pembayarans_id')->unsigned()->index()->nullable();
            $table->foreign('pembayarans_id')->references('id_pembayarans')->on('master_pembayarans')->onUpdate('set null')->onDelete('set null');
            $table->integer('users_id')->unsigned()->index()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->string('no_penjualans');
            $table->datetime('tanggal_penjualans');
            $table->longtext('keterangan_penjualans');
            $table->double('sub_total_penjualans');
            $table->double('diskon_penjualans');
            $table->double('pajak_penjualans');
            $table->double('total_penjualans');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualans');
    }
};
