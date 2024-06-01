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
        Schema::create('nfses', function (Blueprint $table) {
            $table->id();
            $table->integer('nota');
            $table->integer('chave_acesso');
            $table->double('valor');
            $table->foreignId('fatura_id')->references('id')->on('faturas');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfses');
    }
};
