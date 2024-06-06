<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TipoColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_colaboradors')->insert([
            'tipo' => 'Fixado',
            'descricao' => 'Colaborador de carteira assinada',
        ]);
        DB::table('tipo_colaboradors')->insert([
            'tipo' => 'Terceiro',
            'descricao' => 'Colaborador Terceirizado',
        ]);
    }
}
