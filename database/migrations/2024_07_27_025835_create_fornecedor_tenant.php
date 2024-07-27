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
        Schema::create('fornecedor_tenant', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('fornecedor_id')->references('id')->on('fornecedors');
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedor_tenant');
    }
};
