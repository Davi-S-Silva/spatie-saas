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
        Schema::create('carga_entrega', function (Blueprint $table) {
            $table->foreignId('carga_id')->references('id')->on('cargas');
            $table->foreignId('entrega_id')->references('id')->on('entregas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carga_entrega');
    }
};
