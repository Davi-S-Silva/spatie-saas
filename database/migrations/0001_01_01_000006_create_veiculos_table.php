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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa')->unique();
            $table->string('foto_path')->nullable();
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('local_apoio_id')->nullable()->references('id')->on('local_apoios');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->foreignId('proprietario_id')->references('id')->on('proprietarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
