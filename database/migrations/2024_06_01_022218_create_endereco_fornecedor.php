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
        Schema::create('endereco_fornecedor', function (Blueprint $table) {
            $table->foreignId('endereco_id')->references('id')->on('enderecos');
            $table->foreignId('fornecedor_id')->references('id')->on('fornecedors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco_fornecedor');
    }
};
