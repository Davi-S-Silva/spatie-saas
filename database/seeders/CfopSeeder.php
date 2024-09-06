<?php

namespace Database\Seeders;

use App\Models\Cfop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CfopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $row = 1;
        if (($handle = fopen(getenv('RAIZ') . "/utils/cfop.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++) {
                    // echo $data[$c] ."\n";
                    $exp = explode(';',$data[$c]);
                    // echo $exp[0]."-";
                    if(isset($exp[1])){
                        $cfopBD = Cfop::where('codigo',$exp[0])->get();
                        // echo $exp[1]."\n";
                        if($cfopBD->count()==0){
                            $cfop = new Cfop();
                            $cfop->codigo = $exp[0];
                            $cfop->descricao = $exp[1];
                            $cfop->save();
                            echo 'cfop '.$exp[0].' - '.$exp[1].' cadastrado com sucesso'.PHP_EOL;
                        }else{
                            echo 'cfop '.$exp[0].' - '.$exp[1].' já está cadastrado no sistema'.PHP_EOL;
                        }
                    }
                    // echo count($exp);
                }
            }
            fclose($handle);
        }
    }
}
