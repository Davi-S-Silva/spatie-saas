<?php

namespace Database\Seeders;

use App\Models\TipoCte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            [0,'CT-e Normal'],
            [1,'CT-e de Complemento de Valores'],
            [3,'CTe de Substituição'],
        ];
        for($i=0; $i<count($array);$i++){
            $tipoBD = TipoCte::where('codigo',$array[$i][0])->get();
            if($tipoBD->count()==0){
                $tipo = new TipoCte();
                $tipo->newId();
                $tipo->codigo = $array[$i][0];
                $tipo->descricao = $array[$i][1];
                $tipo->save();
                echo 'Tipo Cte - '.$array[$i][1].' cadastrado com sucesso'.PHP_EOL;
            }else{
                echo 'Tipo Cte - '.$array[$i][1].' ja está cadastrado no sistema'.PHP_EOL;
            }
        }
    }
}
