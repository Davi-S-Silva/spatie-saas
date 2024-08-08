<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicosManutencaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            ['descricao'=>'Lanternagem'],
            ['descricao'=>'Mecânica'],
            ['descricao'=>'Pneus'],
            ['descricao'=>'Lavagem'],
            ['descricao'=>'Elétrica'],
            ['descricao'=>'Serviço de ar condicionado'],
            ['descricao'=>'Troca de fluidos e lubrificantes'],
            ['descricao'=>'Tacografo  e Hodometro'],
            // ['descricao'=>'Troca de fluidos e lubrificantes'],
            // ['descricao'=>'Reparo de suspensão'],
            // ['descricao'=>'Troca de correias e tensores'],
            // ['descricao'=>'Alinhamento e balanceamento'],
            // ['descricao'=>'Manutenção de freios'],
        ];
    }
}
