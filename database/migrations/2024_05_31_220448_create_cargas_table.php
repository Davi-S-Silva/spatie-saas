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
        Schema::create('cargas', function (Blueprint $table) {
            $table->id();
            $table->string('destino');
            $table->foreignId('motorista_id')->references('id')->on('colaboradors');
            // $table->double('peso');
            // $table->integer('entregas');
            $table->integer('remessa')->nullable();
            $table->integer('os')->nullable();
            $table->double('frete')->nullable();
            $table->date('data');
            $table->date('agenda');
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->foreignId('filial_id')->references('id')->on('filials');
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('local_apoio_id')->references('id')->on('local_apoios');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->foreignId('veiculo_id')->nullable()->references('id')->on('veiculos');
            $table->integer('diaria')->default(0);
            $table->foreignId('usuario_conclusao_id')->nullable()->references('id')->on('users');
            $table->date('data_conclusao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas');
    }
};
