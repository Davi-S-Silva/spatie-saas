<?php

namespace Database\Seeders;

use App\Models\Cst;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class cstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array =[
            ['00','Tributacao normal ICMS'],
            ['20','Tributacao com BC reduzida do ICMS'],
            ['40','ICMS isenção'],
            ['41','ICMS não tributada'],
            ['51','ICMS diferido'],
            ['60','ICMS cobrado por substituicao tributaria. Responsabilidade do recolhimento do ICMS atribuido ao tomador ou 3° por ST'],
            ['90','ICMS outros'],
            ['90','ICMS devido a UF de origem da prestacao, quando diferente da UF do emitente'],
            ['SN','Simples Nacional'],
        ];
        for($i=0;$i<count($array);$i++){
            $CstDb = Cst::where('codigo',$array[$i][0])->get();
            if($CstDb->count()==0){
                $cst = new Cst();
                $cst->codigo = $array[$i][0];
                $cst->descricao = $array[$i][1];
                $cst->save();
                echo 'Cst '.$array[$i][0]. ' - '.$array[$i][1].' - salvo com sucesso'.PHP_EOL;
            }else{
                echo 'Cst '.$array[$i][0]. ' - '.$array[$i][1].' - já está cadastrado no sistema'.PHP_EOL;
            }
        }
    }
}
