<?php

namespace App\Http\Controllers;

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
        //
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
            DB::commit();
            if(!is_null($Comprovantes) && is_null($PagoDiretoEmpresa)){
                //mover para o s3 somente apos salvar alteracoes no banco
                // $permitido = [
                //     'jpg',
                //     'jpeg',
                //     'png'
                // ];
                foreach($Comprovantes as $comprovante){
                    $comprovante->storeAS('app/public/'.$empresa.'/arquivos/notas/comprovantes/'.$nota->nota.'.'.$comprovante->getClientOriginalExtension());
                }
            }
            return response()->json(['status'=>200,'msg'=>['nota'=>$nota->id,'status'=>$nota->status_id,
            'data_conclusao'=>date('d/m/Y H:i:s'),'user_conclusao'=>$nota->usuarioConclusao->name,
            'obs'=>(!is_null($observacao))?$observacao->descricao:''],'input'=>$request->input()]);
            // return response()->json(['status'=>200,'msg'=>$nota->id,'input'=>$request->input()]);
        }catch(Exception $ex){
            DB::rollBack();
            // return response()->json(['status'=>0,'msg'=>$ex->getMessage(). ' - file: '.$ex->getFile().' - line: '.$ex->getLine()]);
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
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
