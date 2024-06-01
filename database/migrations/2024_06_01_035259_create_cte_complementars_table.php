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
        Schema::create('cte_complementars', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('chave_acesso_cte')->unique();
            $table->foreignId('cte_original_id')->references('id')->on('ctes');
            $table->foreignId('cte_id')->references('id')->on('ctes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cte_complementars');
    }
};
