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
            // $table->unsignedBigInteger('km_id_inicio');
            // $table->foreignId('km_id_inicio')->constrained('kms','id','km_id');
            $table->foreignId('km_inicio_id')->nullable()->references('id')->on('kms');
            $table->foreignId('km_fim_id')->nullable()->references('id')->on('kms');
            // $table->foreignId('km_id')->nullable()->references('id')->on('kms');
            // $table->foreignId('km_fim_id')->nullable()->references('id','km_id')->on('kms');
            // $table->foreignId('km_id_inicio')->nullable()->constrained('kms','id','km_id_inicio');
            // $table->foreignId('km_id_fim')->nullable()->constrained('kms','id','km_id_fim');
            $table->dateTime('data_hora_inicio')->nullable();
            $table->dateTime('data_hora_fim')->nullable();
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('usuario_start_id')->nullable()->references('id')->on('users');
            $table->foreignId('usuario_conclusao_id')->nullable()->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
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
