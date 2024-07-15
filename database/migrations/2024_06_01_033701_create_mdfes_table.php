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
        Schema::create('mdfes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('local_apoio_id')->references('id')->on('local_apoios');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->foreignId('filial_cliente_id')->references('id')->on('filials');
            $table->foreignId('carga_id')->references('id')->on('cargas');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mdfes');
    }
};
