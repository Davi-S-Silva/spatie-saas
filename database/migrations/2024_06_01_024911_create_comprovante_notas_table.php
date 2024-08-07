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
        Schema::create('comprovante_notas', function (Blueprint $table) {
            $table->id();
            $table->double('valor');
            $table->string('path');
            $table->foreignId('nota_id')->references('id')->on('notas');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprovante_notas');
    }
};
