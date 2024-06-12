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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->integer('nota');
            $table->string('chave_acesso')->unique();
            $table->integer('volume');
            $table->integer('prestacao');
            $table->integer('tipo_pagamento');
            $table->double('peso');
            $table->double('valor');
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->foreignId('filial_cliente_id')->references('id')->on('filials');
            $table->foreignId('carga_id')->references('id')->on('cargas');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->foreignId('usuario_conclusao_id')->nullable()->references('id')->on('users');
            $table->foreignId('indicacao_pagamento_id')->references('id')->on('indicacao_pagamentos');
            // $table->foreignId('tipo_pagamento_id')->references('id')->on('tipo_pagamentos');
            $table->date('data_conclusao')->nullable();
            $table->string('path_xml');
            $table->foreignId('destinatario_id')->references('id')->on('destinatarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
