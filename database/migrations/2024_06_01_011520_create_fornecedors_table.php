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
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('doc')->unique();
            $table->string('descricao');
            $table->integer('tipodoc');//fisico ou juridico
            $table->foreignId('especialidade_id')->references('id')->on('especialidades');
            $table->foreignId('endereco_id')->references('id')->on('enderecos');
            // $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedors');
    }
};
