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
        Schema::create('transaksi_pembelians', function (Blueprint $table) {
            $table->increments('id_pembelians');
            $table->integer('tokos_id')->unsigned()->index()->nullable();
            $table->foreign('tokos_id')->references('id_tokos')->on('master_tokos')->onUpdate('set null')->onDelete('set null');
            $table->integer('suppliers_id')->unsigned()->index()->nullable();
            $table->foreign('suppliers_id')->references('id_suppliers')->on('master_suppliers')->onUpdate('set null')->onDelete('set null');
            $table->integer('pembayarans_id')->unsigned()->index()->nullable();
            $table->foreign('pembayarans_id')->references('id_pembayarans')->on('master_pembayarans')->onUpdate('set null')->onDelete('set null');
            $table->unsignedBigInteger('users_id')->index()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->string('no_pembelians');
            $table->string('referensi_no_nota_pembelians');
            $table->datetime('tanggal_pembelians');
            $table->longtext('keterangan_pembelians');
            $table->double('sub_total_pembelians');
            $table->double('diskon_pembelians');
            $table->double('pajak_pembelians');
            $table->double('total_pembelians');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pembelians');
    }
};
