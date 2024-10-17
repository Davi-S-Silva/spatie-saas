<?php

namespace Database\Seeders;

use App\Models\Status as ModelsStatus;
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
        // DB::table('status')->insert([
        //     // 'id'=>1,
        //     'name' => 'Pendente',
        //     'tipo' => 1,
        //     'descricao' => 'Carga pendente',
        // ]);
        // DB::table('status')->insert([
        //     // 'id'=>2,
        //     'name' => 'Aguardando',
        //     'tipo' => 1,
        //     'descricao' => 'Carga aguardando iniciar entrega para seguir rota',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Rota',
        //     'tipo' => 1,
        //     'descricao' => 'Carga em rota para entrega',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Finalizada',
        //     'tipo' => 1,
        //     'descricao' => 'Carga finalizada',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Cancelada',
        //     'tipo' => 1,
        //     'descricao' => 'Carga cancelada',
        // ]);
        //echo 'status das Cargas Salvos com sucesso'.PHP_EOL;

        // Veiculo
        // DB::table('status')->insert([
        //     'name' => 'Disponivel',
        //     'tipo' => 2,
        //     'descricao' => 'Veiculo disponivel',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Indisponivel',
        //     'tipo' => 2,
        //     'descricao' => 'Veiculo indisponivel',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Rota',
        //     'tipo' => 2,
        //     'descricao' => 'Veiculo em rota',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Manutenção',
        //     'tipo' => 2,
        //     'descricao' => 'Veiculo em manutenção',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Vendido',
        //     'tipo' => 2,
        //     'descricao' => 'Veiculo vendido',
        // ]);
        // echo 'status dos Veículos Salvos com sucesso'.PHP_EOL;
         //Movimentação
        // DB::table('status')->insert([
        //     'name' => 'Pendente',
        //     'tipo' => 3,
        //     'descricao' => 'Movimentação Pendente',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Iniciada',
        //     'tipo' => 3,
        //     'descricao' => 'Movimentação Iniciada',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Rota',
        //     'tipo' => 3,
        //     'descricao' => 'Movimentação em rota para o destino',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Finalizada',
        //     'tipo' => 3,
        //     'descricao' => 'Movimentação finalizada',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Cancelada',
        //     'tipo' => 3,
        //     'descricao' => 'Movimentação cancelada',
        // ]);
        // echo 'status das Movimentações Salvos com sucesso'.PHP_EOL;
        //Entrega
        // DB::table('status')->insert([
        //     'name' => 'Pendente',
        //     'tipo' => 4,
        //     'descricao' => 'Entrega Pendente',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Rota',
        //     'tipo' => 4,
        //     'descricao' => 'Entrega em rota',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Finalizada',
        //     'tipo' => 4,
        //     'descricao' => 'Entrega finalizada',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Cancelada',
        //     'tipo' => 4,
        //     'descricao' => 'Entrega Cancelada',
        // ]);
        // echo 'status das Entregas Salvos com sucesso'.PHP_EOL;
        //colaborador
        // DB::table('status')->insert([
        //     'name' => 'Disponivel',
        //     'tipo' => 5,
        //     'descricao' => 'Colaborador disponivel',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Indisponivel',
        //     'tipo' => 5,
        //     'descricao' => 'Colaborador indisponivel',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Rota',
        //     'tipo' => 5,
        //     'descricao' => 'Colaborador em rota de entrega',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Desligado',
        //     'tipo' => 5,
        //     'descricao' => 'Colaborador desligado da empresa',
        // ]);
        // echo 'status dos colaboradores Salvos com sucesso'.PHP_EOL;
// //local de movimentacao
        // DB::table('status')->insert([
        //     'name' => 'Ativo',
        //     'tipo' => 6,
        //     'descricao' => 'Local de movimentação ativa',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Desativado',
        //     'tipo' => 6,
        //     'descricao' => 'Local de movimentação desativado',
        // ]);
        // echo 'status dos Locais de Movimentações Salvos com sucesso'.PHP_EOL;
//NOTAS
        // DB::table('status')->insert([
        //     'name' => 'Pendente',
        //     'tipo' => 7,
        //     'descricao' => 'Nota Pendente',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Entregue',
        //     'tipo' => 7,
        //     'descricao' => 'Nota Entregue',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Aberto',
        //     'tipo' => 7,
        //     'descricao' => 'Nota com pagamento em aberto',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Paga',
        //     'tipo' => 7,
        //     'descricao' => 'Nota Paga',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Finalizada',
        //     'tipo' => 7,
        //     'descricao' => 'Nota Paga e Prestado Conta',
        // ]);

        // DB::table('status')->insert([
        //     'name' => 'Devolvida',
        //     'tipo' => 7,
        //     'descricao' => 'Nota Devolvida',
        // ]);
        // echo 'status das Notas Salvos com sucesso'.PHP_EOL;
 // //MANUTENCAO
        // DB::table('status')->insert([
        //     'name' => 'Aguardando',
        //     'tipo' => 8,
        //     'descricao' => 'Aguardando Autorizacao',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Autorizada',
        //     'tipo' => 8,
        //     'descricao' => 'Manutenção Autorizada',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Pendente',
        //     'tipo' => 8,
        //     'descricao' => 'Manutenção Pendente',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Iniciada',
        //     'tipo' => 8,
        //     'descricao' => 'Manutenção Iniciada',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Finalizada',
        //     'tipo' => 8,
        //     'descricao' => 'Manutenção Finalizada',
        // ]);
        // DB::table('status')->insert([
        //     'name' => 'Cancelada',
        //     'tipo' => 8,
        //     'descricao' => 'Manutenção Cancelada',
        // ]);
        // echo 'status das Manutenções Salvas com sucesso'.PHP_EOL;

        $array = [
            ['name'=>'Pendente', 'tipo'=>1,'descricao'=>'Carga pendente'],
            ['name'=>'Aguardando', 'tipo'=>1,'descricao'=>'Carga aguardando iniciar entrega para seguir rota'],
            ['name'=>'Rota', 'tipo'=>1,'descricao'=>'Carga em rota para entrega'],
            ['name'=>'Finalizada', 'tipo'=>1,'descricao'=>'Carga finalizada'],
            ['name'=>'Rota', 'tipo'=>1,'descricao'=>'Carga em rota para entrega'],
            ['name'=>'Cancelada', 'tipo'=>1,'descricao'=>'Carga Cancelada'],
            ['name'=>'Disponivel', 'tipo'=>2,'descricao'=>'Veiculo Disponivel'],
            ['name'=>'Indisponivel', 'tipo'=>2,'descricao'=>'Veiculo Indisponivel'],
            ['name'=>'Rota', 'tipo'=>2,'descricao'=>'Veiculo em Rota'],
            ['name'=>'Manutenção', 'tipo'=>2,'descricao'=>'Veiculo em Manutenção'],
            ['name'=>'Vendido', 'tipo'=>2,'descricao'=>'Veiculo Vendido'],
            ['name'=>'Pendente', 'tipo'=>3,'descricao'=>'Movimentação Pendente'],
            ['name'=>'Iniciada', 'tipo'=>3,'descricao'=>'Movimentação Iniciada'],
            ['name'=>'Rota', 'tipo'=>3,'descricao'=>'Movimentação em rota para o destino'],
            ['name'=>'Finalizada', 'tipo'=>3,'descricao'=>'Movimentação finalizada'],
            ['name'=>'Cancelada', 'tipo'=>3,'descricao'=>'Movimentação Cancelada'],
            ['name'=>'Pendente', 'tipo'=>4,'descricao'=>'Entrega Pendente'],
            ['name'=>'Rota', 'tipo'=>4,'descricao'=>'Entrega em Rota'],
            ['name'=>'Finalizada', 'tipo'=>4,'descricao'=>'Entrega finalizada'],
            ['name'=>'Cancelada', 'tipo'=>4,'descricao'=>'Entrega Cancelada'],
            ['name'=>'Disponivel', 'tipo'=>5,'descricao'=>'Colaborador disponivel'],
            ['name'=>'Indisponivel', 'tipo'=>5,'descricao'=>'Colaborador Indisponivel'],
            ['name'=>'Rota', 'tipo'=>5,'descricao'=>'Colaborador em rota'],
            ['name'=>'Desligado', 'tipo'=>5,'descricao'=>'Colaborador Desligado da empresa'],
            ['name'=>'Ativo', 'tipo'=>6,'descricao'=>'Local de movimentação ativa'],
            ['name'=>'Desativado', 'tipo'=>6,'descricao'=>'Local de movimentação desativado'],
            ['name'=>'Pendente', 'tipo'=>7,'descricao'=>'Nota Pendente'],
            ['name'=>'Entregue', 'tipo'=>7,'descricao'=>'Nota Entregue'],
            ['name'=>'Aberto', 'tipo'=>7,'descricao'=>'Nota com pagamento em aberto'],
            ['name'=>'Paga', 'tipo'=>7,'descricao'=>'Nota Paga'],
            ['name'=>'Finalizada', 'tipo'=>7,'descricao'=>'Nota Paga e Prestado Conta'],
            ['name'=>'Devolvida', 'tipo'=>7,'descricao'=>'Nota Devolvida'],
            ['name'=>'Aguardando', 'tipo'=>8,'descricao'=>'Aguardando Autorizacao'],
            ['name'=>'Autorizada', 'tipo'=>8,'descricao'=>'Manutenção Autorizada'],
            ['name'=>'Pendente', 'tipo'=>8,'descricao'=>'Manutenção Pendente'],
            ['name'=>'Iniciada', 'tipo'=>8,'descricao'=>'Manutenção Iniciada'],
            ['name'=>'Finalizada', 'tipo'=>8,'descricao'=>'Manutenção Finalizada'],
            ['name'=>'Cancelada', 'tipo'=>8,'descricao'=>'Manutenção Cancelada'],
            ['name'=>'Carregando', 'tipo'=>1,'descricao'=>'Carregando Mercadoria no veiculo'],
            ['name'=>'Carregado', 'tipo'=>1,'descricao'=>'Carregamento Finalizado'],
            ['name'=>'Notas', 'tipo'=>1,'descricao'=>'Aguardando Notas'],
            ['name'=>'Cliente', 'tipo'=>1,'descricao'=>'Aguardando no cliente'],
            ['name'=>'Descarregando', 'tipo'=>1,'descricao'=>'Descarregando mercadoria no cliente'],
            ['name'=>'Descarregado', 'tipo'=>1,'descricao'=>'Descarrego concluido'],
        ];
        foreach($array as $status){
            $Status = ModelsStatus::where('name',$status['name'])->get();
            if($Status->count()==0){
                DB::table('status')->insert([
                    'name' => $status['name'],
                    'tipo' => $status['tipo'],
                    'descricao' =>$status['descricao'],
                ]);
                echo 'status: '.$status['name']. ' Criada com sucesso.'. PHP_EOL;
            }else{
                echo 'status: '.$status['name']. ' Já existe.'. PHP_EOL;
            }
        }
    }
}
