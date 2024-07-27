<?php

namespace Database\Seeders;

use App\Models\TipoPagamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [];
        $tipos[]=['codigo'=>01,'descricao'=>'Dinheiro'];
        $tipos[]=['codigo'=>02,'descricao'=>'Cheque'];
        $tipos[]=['codigo'=>03,'descricao'=>'Cartão de Crédito'];
        $tipos[]=['codigo'=>04,'descricao'=>'Cartão de Débito'];
        $tipos[]=['codigo'=>05,'descricao'=>'Crédito Loja'];
        $tipos[]=['codigo'=>10,'descricao'=>'Vale Alimentação'];
        $tipos[]=['codigo'=>11,'descricao'=>'Vale Refeição'];
        $tipos[]=['codigo'=>12,'descricao'=>'Vale Presente'];
        $tipos[]=['codigo'=>13,'descricao'=>'Vale Combustível'];
        $tipos[]=['codigo'=>15,'descricao'=>'Boleto Bancário'];
        $tipos[]=['codigo'=>90,'descricao'=>'Sem pagamento (apenas para NFe)'];
        $tipos[]=['codigo'=>99,'descricao'=>'Outros'];
        foreach($tipos as $tipo){
            $Tipo = TipoPagamento::where('codigo',$tipo['codigo'])->get();
            if($Tipo->count()==0){
                DB::table('tipo_pagamentos')->insert([
                    'id'=>0,
                    'codigo'=>$tipo['codigo'],
                    'descricao' => $tipo['descricao'],
                    'created_at'=>date('Y/m/d H:m:i')
                ]);
                echo 'Tipo Pagamento: '.$tipo['descricao'].' Cadastrado com sucesso.'.PHP_EOL;
            }else{
                echo 'Tipo Pagamento: '.$tipo['descricao'].' já existe.'.PHP_EOL;
            }
        }
    }
}
