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
        Schema::create('contato_proprietario', function (Blueprint $table) {
            $table->foreignId('proprietario_id')->references('id')->on('proprietarios');
            $table->foreignId('contato_id')->references('id')->on('contatos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contato_proprietario');
    }
};
