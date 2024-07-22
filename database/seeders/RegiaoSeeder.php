<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegiaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(getenv('RAIZ') . '/utils/regioes.json');
        $data = json_decode($json);
        $regioes =  $data->data;

        foreach ($regioes as $value) {
            DB::table('regiaos')->insert([
                'nome' => $value->Nome
            ]);
        }
    }
}
