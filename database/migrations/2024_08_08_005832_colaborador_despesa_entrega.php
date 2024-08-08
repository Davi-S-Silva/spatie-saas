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
        Schema::create('colaborador_despesa_entrega', function (Blueprint $table) {
            $table->foreignId('despesa_entrega_id')->references('id')->on('despesa_entregas');
            $table->foreignId('colaborador_id')->references('id')->on('colaboradors');
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
