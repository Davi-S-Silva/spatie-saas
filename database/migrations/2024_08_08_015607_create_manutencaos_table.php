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
        Schema::create('manutencaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('km_id')->nullable()->references('id')->on('kms');
            $table->foreignId('colaborador_id')->nullable()->references('id')->on('colaboradors');
            $table->foreignId('usuario_solicitacao_id')->references('id')->on('users');
            $table->foreignId('usuario_autorizacao_id')->nullable()->references('id')->on('users');
            $table->dateTime('data_autorizacao')->nullable();
            $table->double('valor')->default(0.00);
            $table->dateTime('agendamento');
            $table->dateTime('data_inicio')->nullable();
            $table->dateTime('data_fim')->nullable();
            $table->foreignId('fornecedor_id')->references('id')->on('fornecedors');
            $table->foreignId('veiculo_id')->references('id')->on('veiculos');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutencaos');
    }
};
