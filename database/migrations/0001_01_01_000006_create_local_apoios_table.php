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
        Schema::create('local_apoios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('usuario_id')->references('id')->on('users');
            // $table->foreignId('endereco _id')->references('id')->on('enderecos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_apoios');
    }
};
