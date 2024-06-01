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
        Schema::create('carga_observacao', function (Blueprint $table) {
            $table->foreignId('carga_id')->references('id')->on('cargas');
            $table->foreignId('observacao_id')->references('id')->on('observacaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carga_observacao');
    }
};
