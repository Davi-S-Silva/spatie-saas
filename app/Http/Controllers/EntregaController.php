<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\Entrega;
use App\Models\Filial;
use App\Models\Km;
use App\Models\LocalMovimentacao;
use App\Models\MovimentacaoVeiculo;
use App\Models\Nota;
use App\Models\Observacao;
use App\Models\Status;
use App\Models\Veiculo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrega = Entrega::with('cargas', 'ajudantes', 'colaborador', 'veiculo')->orderBy('id', 'desc')->paginate(10);
        // $localMovimentacao = LocalMovimentacao::all();
        if (!is_null(Auth::user()->tenant_id)) {
            $localMovimentacao = Auth::user()->tenant->first()->localMovimentacao;
        } else {
            $localMovimentacao = LocalMovimentacao::all();
        }

        // dd($localMovimentacao);
        return view('entrega.index', ['entregas' => $entrega, 'localMovimentacao' => $localMovimentacao]);
        // return view('')
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('entrega.create');

        return view('entrega.create', ['clientes' => Cliente::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $entrega = new Entrega();
            $entrega->newId();
            $Carga = Carga::find($request->Cargas[0]);
            $entrega->cliente_id = $Carga->cliente_id;
            $entrega->filial_id = $Carga->filial_id;
            $Veiculo = Veiculo::find($request->veiculo);
            $lastMovVeiculo = MovimentacaoVeiculo::where('veiculo_id', $Veiculo->id)->get();
            if ($lastMovVeiculo->count() != 0) {
                if ($lastMovVeiculo->last()->status_id == 1 || $lastMovVeiculo->last()->status_id == 2) {
                    throw new Exception('Veiculo está indisponivel, existe movimentação para ' . $lastMovVeiculo->last()->destino->title . ' não concluida para o veiculo');
                }
            }

            // exit;

            if ($Veiculo->status_id == $Veiculo->getStatusId('Disponivel')) {
                $entrega->veiculo_id = $request->veiculo;
            } else {
                throw new Exception('Veiculo está indisponivel');
            }
            $Veiculo->setStatus('Indisponivel'); //veiculo indisponivel
            $Veiculo->save();


            $lastMovVeiculo = MovimentacaoVeiculo::where('veiculo_id', $entrega->veiculo_id)->get();
            if ($lastMovVeiculo->count() != 0) {
                $filial = Filial::find($entrega->filial_id);
                if ($lastMovVeiculo->last()->Local_destino_id != $filial->locaismovimetacoes->first()->id) {
                    throw new Exception('Veiculo está indisponivel para este cliente. O veiculo ' . $Veiculo->placa . ' está em ' . $lastMovVeiculo->last()->destino->title . '. Movimente o veiculo para o cliente ' . $filial->locaismovimetacoes->first()->title);
                }
            }
            // return response()->json([$lastMovVeiculo->last()->getAttributes(),$filial->locaismovimetacoes->first()->id]);
            $entrega->empresa_id = $Carga->empresa_id;
            $entrega->local_apoio_id = $Carga->local_apoio_id;

            $Motorista = Colaborador::find($request->colaborador);


            // return response()->json($Motorista->status('Disponivel'));

            // exit;
            if ($Motorista->status_id == $Motorista->getStatusId('Disponivel')) {
                $entrega->colaborador_id = $request->colaborador;
            } else {
                throw new Exception('Motorista está indisponivel ');
            }
            $Motorista->status_id = $Motorista->getStatusId('Rota');
            $Motorista->save();

            $entrega->setStatus('Pendente'); //entrega pendente
            $entrega->usuario_id = Auth::user()->id;
            $entrega->save();
            //   return response()->json(['status'=>200,'msg'=>$Motorista->status('Disponivel')]);
            // return response()->json($request->input());
            foreach ($request->Cargas as $carga) {
                $Carga = Carga::find($carga);
                if ($Carga->status_id == 1) {
                    $entrega->cargas()->attach($Carga);
                    $Carga->setStatus('Aguardando'); //aguardando seguir rota
                    $Carga->save();
                } else {
                    throw new Exception('Um ou mais carga está indisponivel');
                }
            }
            if (count($request->ajudante) > 0 && $request->ajudante[0] != null) {
                foreach ($request->ajudante as $ajudante) {
                    $Ajudante = Colaborador::find($ajudante);
                    if ($Ajudante->status_id == $Ajudante->getStatusId('Disponivel')) {
                        $entrega->ajudantes()->attach($Ajudante);
                        $Ajudante->setStatus('Indisponivel'); //colaborador indisponivel
                        $Ajudante->save();
                    } else {
                        throw new Exception('Um ou mais ajudante está indisponivel');
                    }
                }
            }
            DB::commit();
            return response()->json(['status' => 200, 'msg' => 'Entrega Cadastrada Com Sucesso!']);
            // return response()->json($request->input());
        } catch (Exception $ex) {
            DB::rollback();
            // return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
            return response()->json(['status' => 0, 'msg' => $ex->getMessage() . ' file: ' . $ex->getFile() . ' linha: ' . $ex->getLine()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrega $entrega)
    {
        return view('entrega.show', ['entrega' => $entrega]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrega $entrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrega $entrega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        //
    }

    public function start(Request $request)
    {
        try {
            DB::beginTransaction();
            $entrega = Entrega::find($request->Entrega);
            $localMov = $entrega->filial->locaismovimetacoes->first();
            // return response()->json(['status'=>200,'msg'=>$localMov]);
            $movPendente = MovimentacaoVeiculo::getMovimentacaoVeiculo($entrega->veiculo_id);
            if ($movPendente->count() != 0) {
                // return response()->json(['status'=>200,'msg'=>$movPendente->last()->status('Rota')]);
                if (
                    $movPendente->last()->status_id == $movPendente->last()->getStatusId('Rota') ||
                    $movPendente->last()->status_id == $movPendente->last()->getStatusId('Pendente') ||
                    $movPendente->last()->status_id == $movPendente->last()->getStatusId('Iniciada')
                ) {
                    throw new Exception('Existe Movimentação não finalizada para veiculo ' . $entrega->veiculo->placa);
                }
            }
            $Mov = new MovimentacaoVeiculo();
            $Mov->newId();
            $Mov->Local_partida_id = $localMov->id;
            $Mov->Local_destino_id = $localMov->getLocalMovimentacao('Rota')->id;
            $Mov->colaborador_id = $entrega->colaborador_id;
            $Mov->veiculo_id = $entrega->veiculo_id;
            $Mov->descricao = $localMov->getLocalMovimentacao('Rota')->descricao . ' do cliente: ' . strtoupper($entrega->filial->nome_fantasia);
            $Mov->data_hora_inicio = date('Y-m-d H:i:s');
            $Mov->usuario_id = Auth::user()->id;
            $veiculo = Veiculo::find($Mov->veiculo_id);
            $veiculo->status_id = $veiculo->getStatusId('Disponivel');
            $veiculo->save();

            $KmModel = new Km();
            $KmModel->setKm($veiculo, $request->KmInicial);
            $KmModel->save();

            $Mov->km_inicio_id = $KmModel->id;
            $Mov->setStatus('Rota'); //movimentacao iniciada
            $Mov->save();
            $entrega->setStatus('Rota');
            $entrega->save();

            //atualizar status da carga
            foreach ($entrega->cargas as $carga) {
                $carga->setStatus('Rota');
                $carga->save();
            }

            DB::commit();
            return response()->json(['status' => 200, 'msg' => 'Entrega Iniciada com sucesso']);
        } catch (Exception $ex) {
            DB::rollback();
            // return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
            return response()->json(['status' => 0, 'msg' => $ex->getMessage() . ' - ' . $ex->getFile() . ' - ' . $ex->getLine()]);
        }
    }

    public function stop(Request $request)
    {
        try {
            DB::beginTransaction();
            $entrega = Entrega::find($request->Entrega);

            //liberar ajudante e motorista
            // ajudantes
            foreach ($entrega->ajudantes as $ajudante) {
                $ajudante->setStatus('Disponivel');
                $ajudante->save();
            }
            // motorista
            $entrega->colaborador->setStatus('Disponivel');
            $entrega->colaborador->save();
            $Mov = MovimentacaoVeiculo::where('veiculo_id', $entrega->veiculo_id)->get()->last();

            //encerrar entrega
            $entrega->status_id = $entrega->getStatusId('Finalizada');
            $entrega->save();


            $veiculo = Veiculo::find($Mov->veiculo_id);
            // $veiculo->status_id=$veiculo->getStatusId('Disponivel');
            // $veiculo->save();

            //verifica km anterior
            //   return response()->json(['status'=>200,'msg'=>$Mov->kmInicio]);
            if ($Mov->kmInicio->km >= $request->KmFinal) {
                throw new Exception('Km final não pode ser menor ou igual a km inicial');
            }
            $KmModel = new Km();
            $KmModel->setKm($veiculo, $request->KmFinal);
            $KmModel->save();
            //encerrar movimentacao
            $Mov->km_fim_id = $KmModel->id;
            $Mov->usuario_conclusao_id = Auth::user()->id;
            $Mov->setStatus('Finalizada');
            $Mov->data_hora_fim = date('Y-m-d H:i:s');
            $Mov->save();

            //VERIFICAR SE O DESTINO E PARTIDA SAO IGUAIS
            if ($Mov->Local_destino_id == (int)$request->LocalDestino) {
                throw new Exception('Local de partida e Local de destino não pode ser o mesmo');
            }
            //NOVA MOVIMENTACAO
            $newMov = new MovimentacaoVeiculo();
            $newMov->newId();
            $newMov->Local_partida_id = $Mov->Local_destino_id;
            $newMov->Local_destino_id = (int)$request->LocalDestino;
            $newMov->colaborador_id = $entrega->colaborador->id;
            $newMov->veiculo_id = $entrega->veiculo_id;
            $newMov->usuario_id = Auth::user()->id;
            $newMov->descricao = (new LocalMovimentacao())->getLocalMovimentacao($entrega->filial->nome_fantasia)->descricao . ' ' . strtoupper($entrega->filial->nome_fantasia);
            $newMov->setStatus('Pendente'); //movimentacao pendente
            $newMov->save();
            // $Mov->km_fim_id =(int) $request->KmFinal;

            //ATUALIZA PARA FINALIZADA A CARGA
            foreach ($entrega->cargas as $carga) {
                $carga->setStatus('Finalizada');
                $carga->save();
            }

            // return response()->json(['status'=>200,'msg'=>$request->input()]);
            DB::commit();
            return response()->json(['status' => 200, 'msg' => 'Entrega Finalizada com sucesso']);
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
        }
    }

    public function receberVariasNotas(Request $request)
    {
        try {
            DB::beginTransaction();
            $notas = [];
            // return response()->json(['status' => 200, 'msg' => $request->input()]);
            if ($request->Receber) {
                //mesmo cliente e mesma forma de pagamento

                DB::commit();
                return response()->json(['status' => 200, 'msg' => ['Receber notas', $request->Motivo]]);
            }
            if ($request->Devolver) {
                //diversos clientes com o mesmo motivo
                foreach ($request->Notas as $idNota) {
                    $nota = Nota::find($idNota);
                    if($nota->status_id != $nota->getStatusId('Pendente')){
                        throw new Exception('Nota '.$nota->nota.' já Finalizada, para alterar alguma informação entre em contato conosco');
                    }
                    // $notas[]=$nota->id;
                    $nota->setStatus('Devolvida');
                    $nota->save();
                    $observacao = new Observacao();
                    $observacao->descricao = $request->Motivo;
                    $observacao->usuario_id = Auth::user()->id;
                    // $observacao->tenant_id = Auth::user()->tenant_id;
                    $observacao->save();
                    $nota->observacoes()->attach($observacao->id);
                }
                DB::commit();
                return response()->json(['status' => 200, 'acao' => 'Devolver', 'notas' => $request->Notas,
                'data_conclusao'=>date('d/m/Y H:i:s'),'user_conclusao'=>$nota->usuarioConclusao->name, 'msg' => ['Motivo', $request->Motivo,'status'=>31]]);
            }
            if ($request->Calcular) {
                $peso = 0;
                $valor = 0;
                $volume = 0;
                foreach ($request->Notas as $idNota) {
                    $nota = Nota::find($idNota);
                    $notas[] = $nota->nota;
                    $peso += $nota->peso;
                    $valor += $nota->valor;
                    $volume += $nota->volume;
                }

                return response()->json([
                    'status' => 200, 'acao' => 'Calcular',
                    'info' => ['peso' => number_format($peso, 2, ',', '.'), 'qtdNotas' => count($request->Notas), 'notas' => $notas, 'valor' => number_format($valor, 2, ',', '.'), 'volume' => $volume]
                ]);
            }

        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
        }
    }
}
