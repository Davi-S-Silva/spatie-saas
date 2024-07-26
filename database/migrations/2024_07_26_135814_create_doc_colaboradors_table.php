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
        Schema::create('doc_colaboradors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_id')->references('id')->on('tipo_docs');
            $table->string('path_img');
            $table->string('numero');
            $table->foreignId('tenant_id')->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_colaboradors');
    }
};
