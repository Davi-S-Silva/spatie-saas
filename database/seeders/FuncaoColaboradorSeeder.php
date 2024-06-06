<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncaoColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Motorista',
            'descricao' => 'Motorista Veicular',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Auxiliar de Carga e Descarga',
            'descricao' => 'Auxiliar de carregamento e descarregamento de mercadorias',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Auxiliar de Serviços Gerais',
            'descricao' => 'Auxiliar de Serviços Gerais',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Auxiliar Administrativo',
            'descricao' => 'Auxiliar Administrativo',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Encarregado de Expedição',
            'descricao' => 'Encarregado de Expedição',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Encarregado Geral',
            'descricao' => 'Encarregado Geral',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Administrador',
            'descricao' => 'Administrador',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Gestor Financeiro',
            'descricao' => 'Gestor Financeiro',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Assistente Financeiro',
            'descricao' => 'Assistente Financeiro',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Estagiario',
            'descricao' => 'Estagiario',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Conferente',
            'descricao' => 'Conferente',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Supervisor',
            'descricao' => 'Supervisor',
        ]);
        DB::table('funcao_colaboradors')->insert([
            'funcao' => 'Encarregado de Manutenção',
            'descricao' => 'Encarregado de Manutenção dos veiculos e equipamentos',
        ]);
    }
}
