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
        Schema::create('master_menus', function (Blueprint $table) {
            $table->increments('id_menus');
            $table->integer('menus_id')->unsigned()->index()->nullable();
            $table->foreign('menus_id')->references('id_menus')->on('master_menus')->onUpdate('set null')->onDelete('set null');
            $table->string('nama_menus');
            $table->string('icon_menus');
            $table->string('link_menus');
            $table->integer('order_menus');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_menus');
    }
};
