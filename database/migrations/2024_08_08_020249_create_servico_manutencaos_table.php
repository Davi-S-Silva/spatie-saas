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
        Schema::create('servico_manutencaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manutencao_servico_id')->references('id')->on('manutencao_servicos');
            $table->text('descricao');
            $table->integer('prazo');
            $table->enum('tipo_prazo',['Dias','KM']);
            $table->double('valor')->default(0.00);
            $table->foreignId('manutencao_id')->references('id')->on('manutencaos');
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servico_manutencaos');
    }
};
