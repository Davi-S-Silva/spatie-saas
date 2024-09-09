<?php

namespace Database\Seeders;

use App\Models\TipoEmissaoCte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEmissaoCteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            [0,'Normal'],
            [4,'EPEC pela SVC'],
            [5,'Contingência'],
        ];
        for($i=0; $i<count($array);$i++){
            $tipoBD = TipoEmissaoCte::where('codigo',$array[$i][0])->get();
            if($tipoBD->count()==0){
                $tipo = new TipoEmissaoCte();
                $tipo->newId();
                $tipo->codigo = $array[$i][0];
                $tipo->descricao = $array[$i][1];
                $tipo->save();
                echo 'Tipo Emissão Cte - '.$array[$i][1].' cadastrado com sucesso'.PHP_EOL;
            }else{
                echo 'Tipo Emissão Cte - '.$array[$i][1].' ja está cadastrado no sistema'.PHP_EOL;
            }
        }
    }
}
