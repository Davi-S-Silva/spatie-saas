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
        Schema::create('local_movimentacaos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('descricao');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_movimentacaos');
    }
};
