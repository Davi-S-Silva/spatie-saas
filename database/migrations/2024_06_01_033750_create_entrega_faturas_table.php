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
        Schema::create('entrega_faturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrega_id')->references('id')->on('entregas');
            $table->foreignId('fatura_id')->references('id')->on('faturas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrega_faturas');
    }
};
