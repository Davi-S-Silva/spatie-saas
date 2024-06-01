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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->integer('entrada');
            $table->integer('saida');
            $table->integer('quantidade_atual');
            $table->integer('minimo');
            $table->foreignId('produto_id')->references('id')->on('produtos');
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('local_apoio_id')->references('id')->on('local_apoios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
