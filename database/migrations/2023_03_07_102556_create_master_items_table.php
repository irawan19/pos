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
        Schema::create('master_items', function (Blueprint $table) {
            $table->increments('id_items');
            $table->integer('tokos_id')->unsigned()->index();
            $table->foreign('tokos_id')->references('id_tokos')->on('master_tokos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('kategori_items_id')->unsigned()->index();
            $table->foreign('kategori_items_id')->references('id_kategori_items')->on('master_kategori_items')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('satuans_id')->unsigned()->index();
            $table->foreign('satuans_id')->references('id_satuans')->on('master_satuans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_items');
            $table->string('nama_items');
            $table->string('foto_items');
            $table->double('harga_items');
            $table->longtext('deskripsi_items');
            $table->double('stok_items');
            $table->double('stok_awal_items');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_items');
    }
};
