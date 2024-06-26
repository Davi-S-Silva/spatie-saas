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
        Schema::create('movimentacao_veiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Local_partida_id')->references('id')->on('local_movimentacaos');
            $table->foreignId('Local_destino_id')->references('id')->on('local_movimentacaos');
            $table->foreignId('veiculo_id')->references('id')->on('veiculos');
            $table->foreignId('colaborador_id')->nullable()->references('id')->on('colaboradors');
            $table->text('descricao');
            $table->integer('km_inicio')->nullable();
            $table->integer('km_fim')->nullable();
            $table->dateTime('data_hora_inicio')->nullable();
            $table->dateTime('data_hora_fim')->nullable();
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('usuario_conclusao_id')->nullable()->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacao_veiculos');
    }
};
