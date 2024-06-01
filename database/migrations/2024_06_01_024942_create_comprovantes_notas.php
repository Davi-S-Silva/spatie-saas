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
        Schema::create('comprovantes_notas', function (Blueprint $table) {
            $table->foreignId('nota_id')->references('id')->on('notas');
            $table->foreignId('comprovante_nota_id')->references('id')->on('comprovante_notas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprovantes_notas');
    }
};
