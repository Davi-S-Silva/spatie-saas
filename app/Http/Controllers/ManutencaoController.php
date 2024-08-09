<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Manutencao;
use App\Models\Observacao;
use App\Models\PrazoServico;
use App\Models\ServicoManutencao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManutencaoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Manutencao', only: ['index']),
            new Middleware('permission:Criar Manutencao', only: ['create', 'store']),
            new Middleware('permission:Show Manutencao', only: ['show']),
            new Middleware('permission:Editar Manutencao', only: ['edit', 'update']),
            new Middleware('permission:Deletar Manutencao', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manutencoes = Manutencao::with('servicos','observacoes')->orderBy('id','desc')->get();
        return view('veiculo.manutencao.index',['manutencoes'=>$manutencoes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!is_null(Auth::user()->tenant_id)){
            $fornecedor = Auth::user()->tenant->first()->fornecedor;
        }else{
            $fornecedor = Fornecedor::all();
        }
        // return view('fornecedor.index', ['fornecedores' => $fornecedor]);
        return view('veiculo.manutencao.create',['fornecedores' => $fornecedor]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $user = Auth::user();
            $manutencao = new Manutencao();
            $manutencao->newId();
            $manutencao->usuario_solicitacao_id = $user->id;
            $manutencao->agendamento = $request->Agendamento;
            $manutencao->fornecedor_id = $request->Fornecedor;
            $manutencao->veiculo_id = $request->veiculo;
            $manutencao->empresa_id = $user->empresa->first()->id;
            $manutencao->status_id = $manutencao->getStatusId('Aguardando');
            $manutencao->save();

            $servicoManutencao = new ServicoManutencao();
            $servicoManutencao->newId();
            $servicoManutencao->servico_id = $request->Servico;
            $servicoManutencao->descricao = $request->DescricaoServico;
            $servicoManutencao->manutencao_id = $manutencao->id;
            $servicoManutencao->save();

            if($request->TipoPrazo != "Nao Aplicavel"){
                $prazoServico = new PrazoServico();
                $prazoServico->prazo = $request->Prazo;
                $prazoServico->tipo_prazo = $request->TipoPrazo;
                $prazoServico->servico_manutencao_id = $servicoManutencao->id;
                $prazoServico->save();
            }

            $observacao = new Observacao();
            $observacao->descricao = $request->Observacao;
            $observacao->usuario_id = $user->id;
            // $observacao->tenant_id = Auth::user()->tenant_id;
            $observacao->save();
            $manutencao->observacoes()->attach($observacao->id);
            DB::commit();
            return response()->json(['status'=>200,'msg'=>['manutencao'=>$manutencao->id,'status'=>'Manutenção criada com sucesso!']]);
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
        return view('veiculo.manutencao.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

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
