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
        Schema::create('cte_notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_id')->references('id')->on('notas');
            $table->foreignId('cte_id')->references('id')->on('ctes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cte_notas');
    }
};
