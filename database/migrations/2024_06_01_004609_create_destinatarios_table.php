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
        Schema::create('destinatarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_razao_social');
            $table->string('cpf_cnpj');
            $table->string('ie');
            $table->integer('tipo');//fisico ou juridico
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('endereco_id')->references('id')->on('enderecos');
            $table->foreignId('contato_id')->references('id')->on('contatos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinatarios');
    }
};
