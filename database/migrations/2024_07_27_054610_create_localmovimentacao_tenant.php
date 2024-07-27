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
        Schema::create('local_movimentacao_tenant', function (Blueprint $table) {
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->foreignId('local_movimentacao_id')->references('id')->on('local_movimentacaos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_movimentacao_tenant');
    }
};
