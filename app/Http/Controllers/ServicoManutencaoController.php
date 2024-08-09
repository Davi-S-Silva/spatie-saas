<?php

namespace App\Http\Controllers;

use App\Models\PrazoServico;
use App\Models\ServicoManutencao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class ServicoManutencaoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Servico Manutencao', only: ['index']),
            new Middleware('permission:Criar Servico Manutencao', only: ['create', 'store']),
            new Middleware('permission:Show Servico Manutencao', only: ['show']),
            new Middleware('permission:Editar Servico Manutencao', only: ['edit', 'update']),
            new Middleware('permission:Deletar Servico Manutencao', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($manutencao)
    {
        return view('veiculo.manutencao.servico-manutencao.create',['manutencao'=>$manutencao]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();


            $servicoManutencao = new ServicoManutencao();
            $servicoManutencao->newId();
            $servicoManutencao->servico_id = $request->Servico;
            $servicoManutencao->descricao = $request->DescricaoServico;
            $servicoManutencao->manutencao_id = $request->Manutencao;
            $servicoManutencao->save();

            if($request->TipoPrazo != "Nao Aplicavel"){
                $prazoServico = new PrazoServico();
                $prazoServico->prazo = $request->Prazo;
                $prazoServico->tipo_prazo = $request->TipoPrazo;
                $prazoServico->servico_manutencao_id = $servicoManutencao->id;
                $prazoServico->save();
            }

            DB::commit();
            return response()->json(['status'=>200,'msg'=>['servico'=>$servicoManutencao->id,'status'=>'Servico adicionado a manutenção com sucesso!']]);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
