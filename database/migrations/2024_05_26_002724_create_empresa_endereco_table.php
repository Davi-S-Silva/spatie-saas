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
        Schema::create('empresa_endereco', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('endereco_id')->references('id')->on('enderecos');
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endereco_empresa');
    }
};
