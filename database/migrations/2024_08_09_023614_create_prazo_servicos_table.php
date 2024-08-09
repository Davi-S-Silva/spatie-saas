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
        Schema::create('prazo_servicos', function (Blueprint $table) {
            $table->id();
            $table->integer('prazo');
            $table->enum('tipo_prazo',['Dias','KM']);
            $table->foreignId('servico_manutencao_id')->references('id')->on('servico_manutencaos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prazo_servicos');
    }
};
