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
        Schema::create('colaborador_contato', function (Blueprint $table) {
            $table->foreignId('colaborador_id')->references('id')->on('colaboradors');
            $table->foreignId('contato_id')->references('id')->on('contatos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaborador_contato');
    }
};
