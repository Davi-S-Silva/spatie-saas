<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        //Carga
        DB::table('status')->insert([
            // 'id'=>1,
            'name' => 'Pendente',
            'tipo' => 1,
            'descricao' => 'Carga pendente',
        ]);
        DB::table('status')->insert([
            // 'id'=>2,
            'name' => 'Aguardando',
            'tipo' => 1,
            'descricao' => 'Carga aguardando iniciar entrega para seguir rota',
        ]);
        DB::table('status')->insert([
            'name' => 'Rota',
            'tipo' => 1,
            'descricao' => 'Carga em rota para entrega',
        ]);
        DB::table('status')->insert([
            'name' => 'Finalizada',
            'tipo' => 1,
            'descricao' => 'Carga finalizada',
        ]);
        DB::table('status')->insert([
            'name' => 'Cancelada',
            'tipo' => 1,
            'descricao' => 'Carga cancelada',
        ]);
        echo 'status das Cargas Salvos com sucesso'.PHP_EOL;
        // Veiculo
        DB::table('status')->insert([
            'name' => 'Disponivel',
            'tipo' => 2,
            'descricao' => 'Veiculo disponivel',
        ]);
        DB::table('status')->insert([
            'name' => 'Indisponivel',
            'tipo' => 2,
            'descricao' => 'Veiculo indisponivel',
        ]);
        DB::table('status')->insert([
            'name' => 'Rota',
            'tipo' => 2,
            'descricao' => 'Veiculo em rota',
        ]);
        DB::table('status')->insert([
            'name' => 'Manutenção',
            'tipo' => 2,
            'descricao' => 'Veiculo em manutenção',
        ]);
        DB::table('status')->insert([
            'name' => 'Vendido',
            'tipo' => 2,
            'descricao' => 'Veiculo vendido',
        ]);
        echo 'status dos Veículos Salvos com sucesso'.PHP_EOL;
        //Movimentação
        DB::table('status')->insert([
            'name' => 'Pendente',
            'tipo' => 3,
            'descricao' => 'Movimentação Pendente',
        ]);
        DB::table('status')->insert([
            'name' => 'Iniciada',
            'tipo' => 3,
            'descricao' => 'Movimentação Iniciada',
        ]);
        DB::table('status')->insert([
            'name' => 'Rota',
            'tipo' => 3,
            'descricao' => 'Movimentação em rota para o destino',
        ]);
        DB::table('status')->insert([
            'name' => 'Finalizada',
            'tipo' => 3,
            'descricao' => 'Movimentação finalizada',
        ]);
        DB::table('status')->insert([
            'name' => 'Cancelada',
            'tipo' => 3,
            'descricao' => 'Movimentação cancelada',
        ]);
        echo 'status das Movimentações Salvos com sucesso'.PHP_EOL;
        //Entrega
        DB::table('status')->insert([
            'name' => 'Pendente',
            'tipo' => 4,
            'descricao' => 'Entrega Pendente',
        ]);
        DB::table('status')->insert([
            'name' => 'Rota',
            'tipo' => 4,
            'descricao' => 'Entrega em rota',
        ]);
        DB::table('status')->insert([
            'name' => 'Finalizada',
            'tipo' => 4,
            'descricao' => 'Entrega finalizada',
        ]);
        DB::table('status')->insert([
            'name' => 'Cancelada',
            'tipo' => 4,
            'descricao' => 'Entrega Cancelada',
        ]);
        echo 'status das Entregas Salvos com sucesso'.PHP_EOL;
        //colaborador
        DB::table('status')->insert([
            'name' => 'Disponivel',
            'tipo' => 5,
            'descricao' => 'Colaborador disponivel',
        ]);
        DB::table('status')->insert([
            'name' => 'Indisponivel',
            'tipo' => 5,
            'descricao' => 'Colaborador indisponivel',
        ]);
        DB::table('status')->insert([
            'name' => 'Rota',
            'tipo' => 5,
            'descricao' => 'Colaborador em rota de entrega',
        ]);
        DB::table('status')->insert([
            'name' => 'Desligado',
            'tipo' => 5,
            'descricao' => 'Colaborador desligado da empresa',
        ]);
        echo 'status dos colaboradores Salvos com sucesso'.PHP_EOL;
        //local de movimentacao
        DB::table('status')->insert([
            'name' => 'Ativo',
            'tipo' => 6,
            'descricao' => 'Local de movimentação ativa',
        ]);
        DB::table('status')->insert([
            'name' => 'Desativado',
            'tipo' => 6,
            'descricao' => 'Local de movimentação desativado',
        ]);
        echo 'status dos Locais de Movimentações Salvos com sucesso'.PHP_EOL;

        //NOTAS
        DB::table('status')->insert([
            'name' => 'Pendente',
            'tipo' => 7,
            'descricao' => 'Nota Pendente',
        ]);
        DB::table('status')->insert([
            'name' => 'Entregue',
            'tipo' => 7,
            'descricao' => 'Nota Entregue',
        ]);
        DB::table('status')->insert([
            'name' => 'Aberto',
            'tipo' => 7,
            'descricao' => 'Nota com pagamento em aberto',
        ]);
        DB::table('status')->insert([
            'name' => 'Paga',
            'tipo' => 7,
            'descricao' => 'Nota Paga',
        ]);
        DB::table('status')->insert([
            'name' => 'Finalizada',
            'tipo' => 7,
            'descricao' => 'Nota Paga e Prestado Conta',
        ]);

        DB::table('status')->insert([
            'name' => 'Devolvida',
            'tipo' => 7,
            'descricao' => 'Nota Devolvida',
        ]);
        echo 'status das Notas Salvos com sucesso'.PHP_EOL;
    }
}
