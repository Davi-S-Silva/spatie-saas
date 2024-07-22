<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvertUfIdCity extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(getenv('RAIZ') . '/utils/municipios.json');
                $data = json_decode($json);
                $dados = $data->data;
                foreach($dados as $municipio){
                    DB::table('convert_uf_id_cities')->insert([
                        'Codigo' => $municipio->Codigo,
                        'Nome' => $municipio->Nome,
                        'UF' => $municipio->Uf
                    ]);
                }
    }
}
