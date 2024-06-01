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
        Schema::create('prestacao_cargas', function (Blueprint $table) {
            $table->id();
            $table->date('data_conclusao');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('carga_id')->references('id')->on('cargas');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestacao_cargas');
    }
};
