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
        Schema::create('filial_local_movimentacao', function (Blueprint $table) {
            $table->foreignId('filial_id')->references('id')->on('filials');
            $table->foreignId('local_movimentacao_id')->references('id')->on('local_movimentacaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filial_local_movimentacao');
    }
};
