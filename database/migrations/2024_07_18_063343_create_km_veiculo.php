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
        Schema::create('km_veiculo', function (Blueprint $table) {
            $table->foreignId('veiculo_id')->references('id')->on('veiculos');
            $table->foreignId('km_id')->references('id')->on('kms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('km_veiculo');
    }
};
