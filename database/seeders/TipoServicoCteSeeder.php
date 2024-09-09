<?php

namespace Database\Seeders;

use App\Models\TipoServicoCte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoServicoCteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            [0,'Normal'],
            [1,'Subcontratação'],
            [3,'Redespacho'],
            [4,'Redespacho Intermediário'],
        ];
        for($i=0; $i<count($array);$i++){
            $tipoBD = TipoServicoCte::where('codigo',$array[$i][0])->get();
            if($tipoBD->count()==0){
                $tipo = new TipoServicoCte();
                $tipo->newId();
                $tipo->codigo = $array[$i][0];
                $tipo->descricao = $array[$i][1];
                $tipo->save();
                echo 'Tipo Serviço Cte - '.$array[$i][1].' cadastrado com sucesso'.PHP_EOL;
            }else{
                echo 'Tipo Serviço Cte - '.$array[$i][1].' ja está cadastrado no sistema'.PHP_EOL;
            }
        }
    }
}
