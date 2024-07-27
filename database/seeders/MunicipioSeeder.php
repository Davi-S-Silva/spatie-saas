<?php

namespace Database\Seeders;

use App\Models\ConvertUfIdCity;
use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $municipios = (new Municipio())->GetMunicipiosJson(getenv('RAIZ') . '/uteis/municipios.json');
        $count=0;
        $cidades = Municipio::count();
        if($cidades == 0){
            $municipios = ConvertUfIdCity::count();
            if($municipios==0){
                $json = file_get_contents(getenv('RAIZ') . '/utils/municipios.json');
                $data = json_decode($json);
                $dados = $data->data;
                foreach($dados as $municipio){
                    DB::table('convert_uf_id_cities')->insert([
                        'Codigo' => $municipio->Codigo,
                        'Nome' => $municipio->Nome,
                        'UF' => $municipio->Uf
                    ]);

                    // echo $load.='.';
                    // if(strlen($load)<=10){
                    //     echo $load.=' - '.PHP_EOL;
                    // }else{
                    //     echo $load.='.';
                    // }
                    // $countLoad++;
                }
            }

            $municipios = ConvertUfIdCity::all();
            foreach ($municipios as $municipio) {
                    switch ($municipio->uf) {
                        case 'RO':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 22;
                             $cidade->save();
                            break;
                        case 'AC':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 1;
                             $cidade->save();
                            break;
                        case 'AM':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 4;
                             $cidade->save();
                            break;
                        case 'RR':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 23;
                             $cidade->save();
                            break;
                        case 'PA':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 14;
                             $cidade->save();
                            break;
                        case 'AP':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 3;
                             $cidade->save();
                            break;
                        case 'TO':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 27;
                             $cidade->save();
                            break;
                        case 'MA':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 10;
                             $cidade->save();
                            break;
                        case 'PI':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 18;
                             $cidade->save();
                            break;
                        case 'CE':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 6;
                             $cidade->save();
                            break;
                        case 'RN':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 20;
                             $cidade->save();
                            break;
                        case 'PB':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 15;
                             $cidade->save();
                            break;
                        case 'PE':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 17;
                             $cidade->save();
                            break;
                        case 'AL':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 2;
                             $cidade->save();
                            break;
                        case 'SE':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 26;
                             $cidade->save();
                            break;
                        case 'BA':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 5;
                             $cidade->save();
                            break;
                        case 'MG':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 13;
                             $cidade->save();
                            break;
                        case 'ES':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 8;
                             $cidade->save();
                            break;
                        case 'RJ':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 19;
                             $cidade->save();
                            break;
                        case 'SP':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 25;
                             $cidade->save();
                            break;
                        case 'PR':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 16;
                             $cidade->save();
                            break;
                        case 'SC':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 26;
                             $cidade->save();
                            break;
                        case 'RS':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 21;
                             $cidade->save();
                            break;
                        case 'MS':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 12;
                             $cidade->save();
                            break;
                        case 'MT':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 11;
                             $cidade->save();
                            break;
                        case 'GO':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 9;
                             $cidade->save();
                            break;
                        case 'DF':
                            echo $municipio->uf . ' - '. $municipio->nome.PHP_EOL;
                            $cidade = new Municipio();
                            $cidade->codigo = $municipio->codigo;
                            $cidade->nome = $municipio->nome;
                            $cidade->estado_id = 7;
                             $cidade->save();
                            break;
                    }

                    $count++;
            }
            echo $count.' cidades salvas com sucesso.'.PHP_EOL;
            Schema::dropIfExists('convert_uf_id_cities');
            echo 'tabela de conversao apagada com sucesso'.PHP_EOL;
            $path = getenv('RAIZ')."/utils/teste.csv";
            $arquivo = fopen($path,"r");
            // echo '<pre>';
            while($linha = fgetcsv($arquivo,100,';')){
                if(isset($linha[2])){
                    $cidade = Municipio::where('codigo',$linha[0])->get()->first();
                    $cidade->longitude = $linha[2];
                    $cidade->latitude = $linha[3];
                    $cidade->save();

                    // echo 'Cidade: '.$cidade->nome. ' - coordenada: long='.$linha[2].' lat='.$linha[3].PHP_EOL;
                }
                // print_r($linha);
            }
            // echo '</pre>';
            echo 'coordenadas atualizadas com sucesso';
        }else{
            echo 'todas as cidades ja estão cadastradas'.PHP_EOL;
        }
    }
}
