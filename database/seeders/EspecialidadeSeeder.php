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
        ];


        foreach($array as $item){
            $qtd = Especialidade::where('name',$item)->get();
            if($qtd->count()==0){
                DB::table('especialidades')->insert([
                    'name' => $item
                ]);
                echo 'Especialidade '.$item.' Criada com sucesso!'.PHP_EOL;
            }else{
                echo 'Especialidade '.$item.' já existe!'.PHP_EOL;
            }
        }
    }
}
