<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            ['name'=>'Lanternagem'],
            ['name'=>'Mecânica'],
            ['name'=>'Pneus'],
            ['name'=>'Lavagem'],
            ['name'=>'Elétrica'],
            ['name'=>'Serviço de ar condicionado'],
            ['name'=>'Troca de fluidos e lubrificantes'],
            ['name'=>'Tacografo  e Hodometro'],
            // ['descricao'=>'Troca de fluidos e lubrificantes'],
            // ['descricao'=>'Reparo de suspensão'],
            // ['descricao'=>'Troca de correias e tensores'],
            // ['descricao'=>'Alinhamento e balanceamento'],
            // ['descricao'=>'Manutenção de freios'],
        ];
        foreach($array as $servico){
            $Servico = Servico::where('name',$servico['name'])->get();
            if($Servico->count()==0){
                DB::table('servicos')->insert([
                    'name' => $servico['name'],
                ]);
                echo 'Servico: '.$servico['name']. ' Criada com sucesso.'. PHP_EOL;
            }else{
                echo 'Servico: '.$servico['name']. ' Já existe.'. PHP_EOL;
            }
        }
    }
}
