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
        Schema::create('fornecedor_servico', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('fornecedor_id')->references('id')->on('fornecedors');
            $table->foreignId('manutencao_servico_id')->references('id')->on('manutencao_servicos');
            // $table->timestamps();
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
