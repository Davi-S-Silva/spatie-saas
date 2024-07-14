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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nome_fantasia');
            $table->integer('tipo_doc');//cpf ou cnpj
            $table->string('doc')->unique();
            $table->string('logo_path')->nullable();
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
