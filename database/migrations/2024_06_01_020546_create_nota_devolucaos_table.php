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
        Schema::create('nota_devolucaos', function (Blueprint $table) {
            $table->id();
            $table->integer('nota');
            $table->double('valor');
            $table->text('descricao');
            $table->string('path');
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->foreignId('filial_cliente_id')->references('id')->on('filials');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_devolucaos');
    }
};
