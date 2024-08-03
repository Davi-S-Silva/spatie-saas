<?php

namespace Database\Seeders;

use App\Models\CategoriaVeiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaVeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayCategoria= [
            'aluguel',
            'particular'
        ];

    foreach ($arrayCategoria as $item) {
        $categoria = CategoriaVeiculo::where('name',$item)->get();
        if($categoria->count()==0){
            DB::table('categoria_veiculos')->insert([
                'name' => $item,
            ]);
            echo 'categoria de veiculo '.$item.' cadastrado com sucesso!'.PHP_EOL;
        }else{
            echo 'categoria de veiculo '.$item.' ja existe no sistema!'.PHP_EOL;
        }
    }
    }
}
