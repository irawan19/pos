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
        Schema::create('master_akses', function (Blueprint $table) {
            $table->increments('id_akses');
            $table->integer('level_sistems_id')->unsigned()->index();
            $table->foreign('level_sistems_id')->references('id_level_sistems')->on('master_level_sistems')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('fiturs_id')->unsigned()->index();
            $table->foreign('fiturs_id')->references('id_fiturs')->on('master_fiturs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_akses');
    }
};
