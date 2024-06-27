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
        Schema::create('local_apoio_local_movimentacao', function (Blueprint $table) {
            $table->foreignId('local_apoio_id')->references('id')->on('local_apoios');
            $table->foreignId('local_movimentacao_id')->references('id')->on('local_movimentacaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_apoio_local_movimentacao');
    }
};
