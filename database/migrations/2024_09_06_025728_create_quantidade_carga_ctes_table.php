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
        Schema::create('quantidade_carga_ctes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cte_id')->references('id')->on('ctes');
            $table->integer('unidade');
            $table->double('valor');
            $table->string('tipo_medida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quantidade_carga_ctes');
    }
};
