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
        Schema::create('fatura_items', function (Blueprint $table) {
            $table->id();
            $table->text('descricao');
            $table->double('valor');
            $table->integer('quantidade');
            $table->foreignId('tipo_item_fatura_id')->references('id')->on('tipo_item_faturas');
            $table->foreignId('entrega_fatura_id')->references('id')->on('entrega_faturas');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fatura_items');
    }
};
