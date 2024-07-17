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
        Schema::create('abastecimentos', function (Blueprint $table) {
            $table->id();
            $table->integer('cupom');
            $table->integer('kmAnterior');
            $table->integer('kmAtual');
            $table->integer('litros');
            $table->double('valor');
            $table->foreignId('combustivel_id')->references('id')->on('combustivels');
            $table->foreignId('fornecedor_id')->references('id')->on('fornecedors');
            $table->foreignId('veiculo_id')->references('id')->on('veiculos');
            $table->foreignId('colaborador_id')->references('id')->on('colaboradors');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abastecimentos');
    }
};
