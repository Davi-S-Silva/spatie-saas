<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicacaoPagamento extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('indicacao_pagamentos')->insert([
            'codigo' => 0,
            'descricao' => 'A Vista',
        ]);
        DB::table('indicacao_pagamentos')->insert([
            'codigo' => 1,
            'descricao' => 'A Prazo',
        ]);
    }
}
