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
        Schema::create('manutencao_observacao', function (Blueprint $table) {
            $table->foreignId('manutencao_id')->references('id')->on('manutencaos');
            $table->foreignId('observacao_id')->references('id')->on('observacaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutencao_observacao');
    }
};
