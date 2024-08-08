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

        // MODIFICAR DEPOIS A RELACAO DE CLIENTE, TENANT E FILIAL
        Schema::create('cliente_tenant', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
