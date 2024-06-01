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
        Schema::create('contato_filial', function (Blueprint $table) {
            $table->foreignId('contato_id')->references('id')->on('contatos');
            $table->foreignId('filial_id')->references('id')->on('filials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contato_filial');
    }
};
