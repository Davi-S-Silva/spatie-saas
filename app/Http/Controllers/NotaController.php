<?php

namespace App\Http\Controllers;

use App\Models\Canhoto;
use App\Models\ComprovanteNota;
use App\Models\Nota;
use App\Models\Observacao;
use App\Models\PagamentoDiretoEmpresa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Nota $nota)
    {
        return view('nota.show',['nota'=>$nota]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nota $nota)
    {
        $statusNota=Nota::GetAllStatus();
        return view('nota.edit',['statusNota'=>$statusNota,'nota'=>$nota]);
    }
    public function editStatusNota(Nota $nota)
    {
        try{
            if($nota->status_id != $nota->getStatusId('Pendente')){
                throw new Exception('Nota já Finalizada, para alterar alguma informação entre em contato conosco');
            }
            $statusNota=Nota::GetAllStatus();
            return view('nota.update',['statusNota'=>$statusNota,'nota'=>$nota]);
        }catch(Exception $ex){
            DB::rollBack();
            // return response()->json(['status'=>0,'msg'=>$ex->getMessage(). ' - file: '.$ex->getFile().' - line: '.$ex->getLine()]);
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }
    public function updateStatusNota(Request $request,Nota $nota)
    {
        try{
            if($nota->status_id != $nota->getStatusId('Pendente')){
                throw new Exception('Nota já Finalizada, para alterar alguma informação entre em contato conosco');
            }
            if($nota->carga->entregas()->first()->getStatus->name=='Pendente')
            {
                throw new Exception('Não é possivel atualizar Nota. Entrega não Iniciada.');
            }
            DB::beginTransaction();
            $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));
            $StatusNota = (!is_null($request->StatusNota))?(int)$request->StatusNota:null;
            $PagoDiretoEmpresa = $request->PagoDiretoEmpresa;
            $Comprovantes = $request->Comprovantes;
            $Obs = $request->ObservacaoNota;
            $pagamentos = [
                1,//dinheiro
                3,//credito
                4,//debito
                ];
                // return response()->json(['status'=>200,'msg'=>$nota,'input'=>$request->input()]);
            if(is_null($StatusNota)){
                throw new Exception('Selecionar Status da nota');
            }
            if($StatusNota == $nota->getStatusId('Entregue')){
                if(((in_array($nota->tipo_pagamento_id,$pagamentos) && $nota->indicacao_pagamento_id==1) || ($nota->tipo_pagamento_id==15 && $nota->indicacao_pagamento_id==1)) && !isset($PagoDiretoEmpresa)){
                    if(is_null($Comprovantes)){
                        throw new Exception('Registar Foto do comprovante...');
                    }
                    $permitido = [
                        'jpg',
                        'jpeg',
                        'png'
                    ];
                    foreach($Comprovantes as $comprovante){
                        if(!in_array($comprovante->getClientOriginalExtension(), $permitido)){
                            throw new Exception('formato de arquivo nao permitido');
                        }
                    }
                }

            }

            if($StatusNota == $nota->getStatusId('Devolvida')){
                if(is_null($Obs)){
                    throw new Exception('Registar o motivo da devolução');
                }
            }
            $nota->status_id= $StatusNota;
            if(!is_null($Obs)){
                $observacao = new Observacao();
                $observacao->descricao = $Obs;
                $observacao->usuario_id = Auth::user()->id;
                // $observacao->tenant_id = Auth::user()->tenant_id;
                $observacao->save();
                $nota->observacoes()->attach($observacao->id);
            }else{
                $observacao=null;
            }
            if($StatusNota == $nota->getStatusId('Entregue') && !is_null($PagoDiretoEmpresa)){
                if(is_null($Obs)){
                    throw new Exception('Registar uma observacao sobre o pagamento direto a empresa');
                }
                $pagEmpresa = new PagamentoDiretoEmpresa();
                $pagEmpresa->nota_id = $nota->id;
                $pagEmpresa->usuario_id = Auth::user()->id;
                $pagEmpresa->empresa_id = Auth::user()->empresa->first()->id;
                $pagEmpresa->filial_id = $nota->filial_id;
                $pagEmpresa->observacao_id = $observacao->id;
                $pagEmpresa->save();
            }
            if($StatusNota == $nota->getStatusId('Devolvida') && !is_null($PagoDiretoEmpresa)){
                throw new Exception('Desmarque a opcao "Pagamento direto a empresa" para notas devolvidas');
            }
            $nota->usuario_conclusao_id = Auth::user()->id;
            $nota->data_conclusao = date('Y-m-d');
            $nota->save();



            // exit;
            // return response()->json(['status'=>200,'msg'=>['nota'=>$nota->id,'status'=>$nota->status_id,'user_conclusao'=>$nota->usuarioConclusao->name,'obs'=>(!is_null($observacao))?$observacao->descricao:''],'input'=>$request->input()]);
            // return response()->json(['status'=>200,'msg'=>['nota'=>$nota,'obs'=>(!is_null($observacao))?$observacao->descricao:''],'input'=>$request->input()]);

            if(!is_null($Comprovantes) && is_null($PagoDiretoEmpresa)){
                //mover para o s3 somente apos salvar alteracoes no banco
                // $permitido = [
                //     'jpg',
                //     'jpeg',
                //     'png'
                // ];
                foreach($Comprovantes as $comprovante){
                    $path = $comprovante->storeAS('app/public/'.$empresa.'/arquivos/notas/comprovantes/'.$nota->nota.'.'.$comprovante->getClientOriginalExtension());
                    $comprovanteNota = new ComprovanteNota();
                    $comprovanteNota->path = $path;
                    $comprovanteNota->nota_id  = $nota->id;
                    $comprovanteNota->user_id  = Auth::user()->id;
                    $comprovanteNota->save();
                }
            }
            DB::commit();
            return response()->json(['status'=>200,'msg'=>['nota'=>$nota->id,'status'=>$nota->status_id,
            'data_conclusao'=>date('d/m/Y H:i:s'),'user_conclusao'=>$nota->usuarioConclusao->name,
            'obs'=>(!is_null($observacao))?$observacao->descricao:''],'input'=>$request->input()]);
            // return response()->json(['status'=>200,'msg'=>$nota->id,'input'=>$request->input()]);
        }catch(Exception $ex){
            DB::rollBack();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage(). ' - file: '.$ex->getFile().' - line: '.$ex->getLine()]);
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }

    public function updateStatusNotas(Request $request)
    {
        try{
            DB::beginTransaction();
            $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));
            // $StatusNota = (!is_null($request->StatusNota))?(int)$request->StatusNota:null;
            $PagoDiretoEmpresa = $request->PagoDiretoEmpresa;
            $Comprovantes = $request->Comprovantes;
            $Obs = $request->ObservacaoNota;
            $pagamentos = [
                1,//dinheiro
                3,//credito
                4,//debito
                ];
            $Comprovantes = $request->file('Comprovantes');
            $Canhotos = $request->file('FotoCanhotos');
            $Notas = explode('-',$request->Notas);
            $stringNota = '';
            $i=0;
            // throw new Exception('notas: '.$request->Notas);
            // foreach($Notas as $item){
            //     $nota = Nota::find($item);
            //     $stringNota .= ($i < count($Notas))?$nota->nota.'-':$nota->nota;
            // }
            // throw new Exception('notas: '.$stringNota);
            foreach($Notas as $item){
                // if(!is_null($item)){
                    $nota = Nota::find($item);
                    $stringNota .= ($i < count($Notas))?$nota->nota.'-':$nota->nota;
                    // $stringNota .= $item;
                    // throw new Exception('nota: '.$nota->nota);
                    $i++;
                // }

                if($nota->status_id != $nota->getStatusId('Pendente')){
                    throw new Exception('Nota já Finalizada, para alterar alguma informação entre em contato conosco');
                }
                if(((in_array($nota->tipo_pagamento_id,$pagamentos) && $nota->indicacao_pagamento_id==1) || ($nota->tipo_pagamento_id==15 && $nota->indicacao_pagamento_id==1)) && !isset($PagoDiretoEmpresa)){
                    if(is_null($Comprovantes)){
                        throw new Exception('Registar Foto do comprovante...');
                    }
                    $permitido = [
                        'jpg',
                        'jpeg',
                        'png'
                    ];
                    foreach($Comprovantes as $comprovante){
                        if(!in_array($comprovante->getClientOriginalExtension(), $permitido)){
                            throw new Exception('formato de arquivo nao permitido');
                        }
                    }
                }
                if(!is_null($Obs)){
                    $observacao = new Observacao();
                    $observacao->descricao = $Obs;
                    $observacao->usuario_id = Auth::user()->id;
                    // $observacao->tenant_id = Auth::user()->tenant_id;
                    $observacao->save();
                    $nota->observacoes()->attach($observacao->id);
                }else{
                    $observacao=null;
                }

                if(!is_null($PagoDiretoEmpresa)){
                    if(is_null($Obs)){
                        throw new Exception('Registar uma observacao sobre o pagamento direto a empresa');
                    }
                    $pagEmpresa = new PagamentoDiretoEmpresa();
                    $pagEmpresa->nota_id = $nota->id;
                    $pagEmpresa->usuario_id = Auth::user()->id;
                    $pagEmpresa->empresa_id = Auth::user()->empresa->first()->id;
                    $pagEmpresa->filial_id = $nota->filial_id;
                    $pagEmpresa->observacao_id = $observacao->id;
                    $pagEmpresa->save();
                }
                $nota->usuario_conclusao_id = Auth::user()->id;
                $nota->data_conclusao = date('Y-m-d');
                $nota->setStatus('Entregue');
                // if($nota->status_id ==$nota->getStatusId('Entregue')){
                //     if(is_null($Canhotos)){
                //         throw new Exception('Tirar foto dos canhotos assinados');
                //     }
                // }
                // throw new Exception('Nota: '.$nota->nota);
                $nota->save();

            }

            // return response()->json(['status'=>200,'msg'=>'teste']);

            // if(!is_null($Canhotos))
            // {
            //     $path = $Canhotos->storeAS('app/public/'.$empresa.'/arquivos/notas/canhotos/'.$stringNota.'.'.$Canhotos->getClientOriginalExtension());
            //     $canhoto = new Canhoto();
            //     $canhoto->path = $path;
            //     $canhoto->nota_id = $nota->id;
            //     $canhoto->save();
            // }
            if(!is_null($Comprovantes) && is_null($PagoDiretoEmpresa)){
                // mover para o s3 somente apos salvar alteracoes no banco
                // $permitido = [
                //     'jpg',
                //     'jpeg',
                //     'png'
                // ];
                $a=1;
                foreach($Comprovantes as $comprovante){
                    $path =  $comprovante->storeAS('app/public/'.$empresa.'/arquivos/notas/comprovantes/'.$stringNota.'_'.$a.'.'.$comprovante->getClientOriginalExtension());
                    $a++;
                    // $path = $comprovante->storeAS('app/public/'.$empresa.'/arquivos/notas/comprovantes/'.$nota->nota.'.'.$comprovante->getClientOriginalExtension());
                    $comprovanteNota = new ComprovanteNota();
                    $comprovanteNota->path = $path;
                    $comprovanteNota->nota_id  = $nota->id;
                    $comprovanteNota->user_id  = Auth::user()->id;
                    $comprovanteNota->save();
                }
            }
            DB::commit();
            return response()->json(['status'=>200,'msg'=>['notas'=>$Notas,'status'=>$nota->status_id,
            'data_conclusao'=>date('d/m/Y H:i:s'),'user_conclusao'=>$nota->usuarioConclusao->name,
            'obs'=>(!is_null($observacao))?$observacao->descricao:''],'input'=>$request->input()]);
            // return response()->json(['status'=>200,'msg'=>$request->input() ]);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage(). ' - file: '.$ex->getFile().' - line: '.$ex->getLine()]);
            return response()->json(['status'=>0,'msg'=>$ex->getMessage() ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nota $nota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nota $nota)
    {
        //
    }


}
