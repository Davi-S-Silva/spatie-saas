<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Km;
use App\Models\LocalMovimentacao;
use App\Models\MovimentacaoVeiculo;
use App\Models\Veiculo;
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
        $mov = MovimentacaoVeiculo::with('partida','destino','veiculo','colaborador')->orderBy('id','desc')->paginate(20);
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
            // $class = get_class_vars('App\Models\Colaborador');
            if($colabBd->status_id!=$colabBd->getStatusId('Disponivel')){
                throw new Exception('Motorista Indisponivel');
            }
            $colabBd->status_id=21;
            $colabBd->save();


            $Colaborador = $request->colaborador;
            $Veiculo = $request->veiculo;



            $lastMovVeiculo = MovimentacaoVeiculo::where('veiculo_id',$Veiculo)->get();
            if($lastMovVeiculo->count()!=0){
                if($lastMovVeiculo->last()->Local_destino_id != $Partida){
                    throw new Exception('Movimentacao incorreta. o veiculo está atualmente em '.LocalMovimentacao::find($lastMovVeiculo->last()->Local_destino_id)->title);
                }
                if($lastMovVeiculo->last()->status_id==1){
                    throw new Exception('Existe movimentação não concluida para o veiculo');
                }
            }

            // $movBd = MovimentacaoVeiculo::where('Local_partida_id',$Partida)->where('Local_destino_id',$Destino)
            // ->where('status_id',$lastMovVeiculo->getStatusId('Disponivel'))->where('veiculo_id',$Veiculo)->get();
            // if($movBd->count()!=0){
            //     throw new Exception('Já existe uma movimentacao para esse destino com esse veiculo');
            // }


            $DescMov = htmlspecialchars($request->DescricaoMov,ENT_QUOTES);
            $Mov = new MovimentacaoVeiculo();
            $Mov->Local_partida_id = $Partida;
            $Mov->Local_destino_id = $Destino;
            $Mov->colaborador_id = $Colaborador;
            $Mov->veiculo_id = $Veiculo;
            $Mov->descricao = $DescMov;
            $Mov->usuario_id = Auth::user()->id;
            $Mov->setStatus('Pendente');//movimentacao pendente
            $Mov->save();

            $veiculo = Veiculo::find($Veiculo);
            if($veiculo->status_id!=$veiculo->getStatusId('Disponivel')){
                throw new Exception('Veiculo está indisponivel');
            }
            $veiculo->status_id=$veiculo->getStatusId('Indisponivel');//
            $veiculo->save();
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Movimentação cadastrada com sucesso']);
            // return response()->json($request->input());
        }catch(Exception $ex){
            DB::rollback();
            return response()->json($ex->getMessage());
            // return response()->json($ex->getMessage() . 'File: '.$ex->getFile(). 'Line: '.$ex->getLine());
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

    public function start(Request $request){
        try{
            // throw new Exception('trocando as informacoes do km');
            DB::beginTransaction();
            $movimentacaoVeiculo = MovimentacaoVeiculo::find($request->Mov);
            if(($movimentacaoVeiculo->status_id==$movimentacaoVeiculo->getStatusId('Iniciada')) || ($movimentacaoVeiculo->status_id==$movimentacaoVeiculo->getStatusId('Rota'))){
                throw new Exception('Movimentação já iniciada');
            }
            $KmInicial = (int)filter_var($request->KmInicial, FILTER_SANITIZE_NUMBER_INT);
            //verificar se o km digitado é maior que o ultimo km_final registrado para o veiculo
            $UltimoKmFinalVeiculo = MovimentacaoVeiculo::where('veiculo_id', $movimentacaoVeiculo->veiculo_id)->get();


            if($UltimoKmFinalVeiculo->count()!=0){
                $ultimo_km_fim = $UltimoKmFinalVeiculo->last()->km_fim;
                // throw new Exception('trocando as informacoes do km');
                // return response()->json($ultimo_km_fim);
                if($KmInicial<$ultimo_km_fim){
                    throw new Exception('Km Atual não pode ser menor que o km anterior');
                }
            }


            $veiculo = Veiculo::find($movimentacaoVeiculo->veiculo_id);
            $veiculo->status_id=2;
            $veiculo->save();
            $KmModel = new Km();
            $KmModel->setKm($veiculo,$KmInicial);
            $KmModel->save();
            $movimentacaoVeiculo->km_inicio = $KmModel->id;
            $movimentacaoVeiculo->usuario_start_id = Auth::user()->id;
            $movimentacaoVeiculo->data_hora_inicio = date('Y-m-d H:i:s');
            $movimentacaoVeiculo->status_id = $movimentacaoVeiculo->getStatusId('Rota');
            $movimentacaoVeiculo->colaborador_id= $request->colaborador;
            $movimentacaoVeiculo->save();

            $colaborador = Colaborador::find($request->colaborador);
            $colaborador->status_id=$colaborador->getStatusId('Indisponivel');
            $colaborador->save();
            // throw new Exception('trocando as informacoes do km');

            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Movimentação '.$movimentacaoVeiculo->id.' iniciada com sucesso','mov'=>$movimentacaoVeiculo->getAttributes()]);
        }catch(Exception $ex){
            DB::rollback();
            // return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
            return response()->json(['status'=>0, 'msg'=>$ex->getMessage() . 'File: '.$ex->getFile(). 'Line: '.$ex->getLine()]);
        }
    }

    public function stop(Request $request){
        try{
            DB::beginTransaction();
            $movimentacaoVeiculo = MovimentacaoVeiculo::find($request->Mov);
            if($movimentacaoVeiculo->status_id ==1){
                throw new Exception('Movimentação não pode ser encerrada pois ainda não foi iniciada');
            } else if($movimentacaoVeiculo->status_id ==3){
                throw new Exception('Não é possivel encerrar uma movimentação já encerrada');
            }
            $KmFinal = (int)filter_var($request->KmFinal, FILTER_SANITIZE_NUMBER_INT);
            //verificar se o km digitado é maior que o ultimo km_inicio registrado para o veiculo
            if($movimentacaoVeiculo->km_inicio > $KmFinal){
                throw new Exception('Km Final não pode ser menor que o km inicial');
            }
            $movimentacaoVeiculo->status_id = 3;
            $movimentacaoVeiculo->km_fim = $KmFinal;
            $movimentacaoVeiculo->data_hora_fim = date('Y-m-d H:i:s');
            $movimentacaoVeiculo->usuario_conclusao_id = Auth::user()->id;
            $movimentacaoVeiculo->save();
            $veiculo = Veiculo::find($movimentacaoVeiculo->veiculo_id);
            $veiculo->status_id=1;
            $veiculo->save();
            $colaborador = Colaborador::find($movimentacaoVeiculo->colaborador_id);
            $colaborador->status_id=1;
            $colaborador->save();
            // return response()->json($request);
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Movimentação '.$movimentacaoVeiculo->id.' encerrada com sucesso','mov'=>$movimentacaoVeiculo->getAttributes()]);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }
}
