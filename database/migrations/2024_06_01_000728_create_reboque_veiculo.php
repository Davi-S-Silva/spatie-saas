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
        Schema::create('reboque_veiculo', function (Blueprint $table) {
            $table->foreignId('veiculo_id')->nullable()->references('id')->on('veiculos');
            $table->foreignId('reboque_id')->nullable()->references('id')->on('veiculos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reboque_veiculo');
    }
};
