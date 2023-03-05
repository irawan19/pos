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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('level_sistems_id')->unsigned()->index()->nullable();
            $table->foreign('level_sistems_id')->references('id_level_sistems')->on('master_level_sistems')->onUpdate('set null')->onDelete('set null');
            $table->integer('tokos_id')->unsigned()->index()->nullable();
            $table->foreign('tokos_id')->references('id_tokos')->on('master_tokos')->onUpdate('set null')->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
