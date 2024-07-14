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
        Schema::create('dados_conta_bancos', function (Blueprint $table) {
            $table->id();
            $table->integer('agencia');
            $table->integer('operacao');
            $table->integer('conta');
            $table->foreignId('conta_id')->references('id')->on('conta_pagamentos');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados_conta_bancos');
    }
};
