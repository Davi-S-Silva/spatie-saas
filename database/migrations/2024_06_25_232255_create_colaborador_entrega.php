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
        Schema::create('colaborador_entrega', function (Blueprint $table) {
            $table->foreignId('colaborador_id')->references('id')->on('colaboradors');
            $table->foreignId('entrega_id')->references('id')->on('entregas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaborador_entrega');
    }
};
