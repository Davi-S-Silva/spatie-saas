<?php

namespace Database\Seeders;

use App\Models\Especialidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'Combustível',
            'Peças',
            'Manutenção',
            'Mecânico',
            'Eletricista',
            'Pneu',
        ];



        foreach($array as $item){
            $qtd = Especialidade::where('nome',$item)->get();
            if($qtd->count()==0){
                DB::table('especialidades')->insert([
                    'nome' => $item,
                    'descricao'=>'',
                ]);
                echo 'Especialidade '.$item.' Criada com sucesso!'.PHP_EOL;
            }else{
                echo 'Especialidade '.$item.' já existe!'.PHP_EOL;
            }
        }
    }
}
