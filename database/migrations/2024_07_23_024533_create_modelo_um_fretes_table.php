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
        Schema::create('modelo_um_fretes', function (Blueprint $table) {
            $table->id();
            $table->text('cidades');
            $table->double('um')->default(0);//1 entrega
            $table->double('dois')->default(0);// 2 a 3 entregas
            $table->double('tres')->default(0);//4 a 5 entregas
            $table->double('quatro')->default(0);//6  a 7 entregas
            $table->double('cinco')->default(0);//8 a 10 entregas
            $table->double('seis')->default(0);//11 a 13  entregas
            $table->double('sete')->default(0);//14 a a16 entregas
            $table->double('oito')->default(0);//17 a 19 netregas
            $table->double('nove')->default(0);//20 a 23 entregas
            $table->double('dez')->default(0);//24 a 25 entregas
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelo_um_fretes');
    }
};
