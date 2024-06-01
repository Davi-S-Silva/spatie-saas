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
        Schema::create('entrega_observacao', function (Blueprint $table) {
            $table->foreignId('entrega_id')->references('id')->on('entregas');
            $table->foreignId('observacao_id')->references('id')->on('observacaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrega_observacao');
    }
};
