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
        Schema::create('movimentacao_estoques', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->foreignId('estoque_id')->references('id')->on('estoques');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('colaborador_id')->references('id')->on('colaboradors');
            $table->text('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacao_estoques');
    }
};
