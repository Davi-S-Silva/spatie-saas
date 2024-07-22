<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(getenv('RAIZ') . '/utils/estados.json');
        $data = json_decode($json);
        $estados =  $data->data;

        foreach ($estados as $value) {
            DB::table('estados')->insert([
                'codigo' => $value->CodigoUf,
                'nome' => $value->Nome,
                'uf' => $value->Uf,
                'regiao_id' => $value->Regiao,
            ]);
        }
    }
}
