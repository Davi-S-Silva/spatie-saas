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
        Schema::create('pixes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('chave')->unique();
            $table->foreignId('conta_id')->references('id')->on('conta_pagamentos');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pixes');
    }
};
