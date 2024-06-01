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
        Schema::create('devolucao_produto', function (Blueprint $table) {
            $table->foreignId('produto_id')->references('id')->on('produto_notas');
            $table->foreignId('nota_id')->references('id')->on('nota_devolucaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucao_produto');
    }
};
