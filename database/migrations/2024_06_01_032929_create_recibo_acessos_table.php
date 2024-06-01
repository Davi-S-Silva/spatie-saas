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
        Schema::create('recibo_acessos', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->double('valor');
            $table->text('descricao');
            $table->foreignId('prestacao_carga_id')->references('id')->on('prestacao_cargas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibo_acessos');
    }
};
