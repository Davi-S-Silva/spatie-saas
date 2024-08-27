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
        Schema::create('file_cargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carga_id')->references('id')->on('cargas');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('tipo');
            $table->string('name');
            $table->text('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_cargas');
    }
};
