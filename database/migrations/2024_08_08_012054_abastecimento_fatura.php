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
        Schema::create('abastecimento_fatura', function (Blueprint $table) {
            $table->foreignId('fatura_id')->references('id')->on('faturas');
            $table->foreignId('abastecimento_id')->references('id')->on('abastecimentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
