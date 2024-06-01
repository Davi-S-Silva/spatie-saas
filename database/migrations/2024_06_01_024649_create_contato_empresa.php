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
        Schema::create('contato_empresa', function (Blueprint $table) {
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('contato_id')->references('id')->on('contatos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contato_empresa');
    }
};
