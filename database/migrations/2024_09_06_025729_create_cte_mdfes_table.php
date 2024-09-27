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
        Schema::create('cte_mdfes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cte_id')->references('id')->on('ctes');
            $table->foreignId('mdfe_id')->references('id')->on('mdfes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cte_mdfes');
    }
};
