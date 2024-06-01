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
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apelido')->nullable();
            $table->string('foto_path')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->foreignId('tipo_id')->references('id')->on('tipo_colaboradors');
            $table->foreignId('funcao_id')->references('id')->on('funcao_colaboradors');
            $table->foreignId('empresa_id')->references('id')->on('empresas');
            $table->foreignId('local_apoio_id')->references('id')->on('local_apoios');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaboradors');
    }
};
