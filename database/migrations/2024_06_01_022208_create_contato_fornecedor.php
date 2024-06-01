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
        Schema::create('contato_fornecedor', function (Blueprint $table) {
            $table->foreignId('contato_id')->references('id')->on('contatos');
            $table->foreignId('fornecedor_id')->references('id')->on('fornecedors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contato_fornecedor');
    }
};
