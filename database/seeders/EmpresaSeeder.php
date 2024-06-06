<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('empresas')->insert([
            'nome' => 'SaaS Portal',
            'nome_fantasia' => 'SaaS Portal',
            'tipo_doc' => 1,
            'doc' => 00000000000,
            'usuario_id'=> 1
        ]);
    }
}
