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
        Schema::create('fatura_abastecimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fornecedor_id')->references('in')->on('fornecedors');
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fatura_abastecimentos');
    }
};
