<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\LocalMovimentacao;
use App\Models\MovimentacaoVeiculo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovimentacaoVeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mov = MovimentacaoVeiculo::all();
        return view('veiculo.movimentacao.index',['movimentacoes'=>$mov]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $localMov = LocalMovimentacao::all();
        return view('veiculo.movimentacao.create',['localMovimentacao'=>$localMov]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{

            $Partida = $request->LocalPartida;
            $Destino = $request->LocalDestino;
            $colabBd = Colaborador::find($request->colaborador);
            if($colabBd->status_id!=1){
                throw new Exception('Motorista Indisponivel');
            }
            $colabBd->status_id=2;
            $colabBd->save();

            $Colaborador = $request->colaborador;
            $Veiculo = $request->veiculo;

            $lastMovVeiculo = MovimentacaoVeiculo::where('veiculo_id',$Veiculo)->get();
            if($lastMovVeiculo->count()!=0){
                if($lastMovVeiculo->last()->Local_destino_id != $Partida){
                    throw new Exception('Movimentacao incorreta. o veiculo está atualmente em '.LocalMovimentacao::find($lastMovVeiculo->last()->Local_destino_id)->title);
                }
            }

            $movBd = MovimentacaoVeiculo::where('Local_partida_id',$Partida)->where('Local_destino_id',$Destino)
            ->where('status_id',1)->where('veiculo_id',$Veiculo)->get();
            if($movBd->count()!=0){
                throw new Exception('Já existe uma movimentacao para esse destino com esse veiculo');
            }


            $DescMov = htmlspecialchars($request->DescricaoMov,ENT_QUOTES);
            $Mov = new MovimentacaoVeiculo();
            $Mov->Local_partida_id = $Partida;
            $Mov->Local_destino_id = $Destino;
            $Mov->colaborador_id = $Colaborador;
            $Mov->veiculo_id = $Veiculo;
            $Mov->descricao = $DescMov;
            $Mov->usuario_id = Auth::user()->id;
            $Mov->status_id = 1;

            $Mov->save();
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Movimentação cadastrada com sucesso']);
            // return response()->json($request->input());
        }catch(Exception $ex){
            DB::rollback();
            return response()->json($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MovimentacaoVeiculo $movimentacaoVeiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovimentacaoVeiculo $movimentacaoVeiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovimentacaoVeiculo $movimentacaoVeiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovimentacaoVeiculo $movimentacaoVeiculo)
    {
        //
    }
}
