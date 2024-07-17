<?php

namespace Database\Seeders;

use App\Models\Combustivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CombustivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'ÁLCOOL',
            'GASOLINA',
            'GNV',
            'DIESEL',
            'FLEX',
        ];


        foreach($array as $item){
            $qtd = Combustivel::where('name',$item)->get();
            if($qtd->count()==0){
                DB::table('combustivels')->insert([
                    'name' => $item
                ]);
                echo 'Combustivel '.$item.' Criada com sucesso!'.PHP_EOL;
            }else{
                echo 'Combustivel '.$item.' já existe!'.PHP_EOL;
            }
        }
    }
}
