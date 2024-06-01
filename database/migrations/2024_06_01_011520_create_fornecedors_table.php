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
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->id();
            $table->string('nome_razao_social');
            $table->integer('cpf_cnpj')->unique();
            $table->integer('tipo');//fisico ou juridico
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('endereco_id')->references('id')->on('enderecos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedors');
    }
};
