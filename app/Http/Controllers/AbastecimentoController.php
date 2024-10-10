<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Colaborador;
use App\Models\Fornecedor;
use App\Models\Km;
use App\Models\Uteis;
use App\Models\Veiculo;
use Exception;
use Illuminate\Http\File;
use Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AbastecimentoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Abastecimento', only: ['index']),
            new Middleware('permission:Criar Abastecimento', only: ['create', 'store']),
            new Middleware('permission:Show Abastecimento', only: ['show']),
            new Middleware('permission:Editar Abastecimento', only: ['edit', 'update']),
            new Middleware('permission:Deletar Abastecimento', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // // apaga todas as sessoes referente as cargas para nao da erro na query
        // session()->forget('carga_data_inicio');
        // session()->forget('carga_data_fim');
        // session()->forget('carga_colaborador_id');
        // session()->forget('carga_veiculo_id');
        // session()->forget('carga_origem');
        // session()->forget('carga_status');
        // session()->forget('carga_diarias');
        // session()->forget('carga_NumeroDoc');
        // dump($request->input());
        if(Auth::user()->roles()->first()->name== 'tenant-colaborador' || Auth::user()->roles()->first()->name== 'colaborador'){
            $abast = Abastecimento::orderBy('id','desc')->where('colaborador_id',Auth::user()->colaborador->first()->id)->with('veiculo','colaborador');
        }else{
            $abast = Abastecimento::with('veiculo','colaborador');
        }
        if(!is_null($request->Reset)){
            session()->forget('abastecimento_order-by-items-item');
            session()->forget('abastecimento_order-by-items-order');
            session()->forget('abastecimento_paginate-by-page');
            session()->forget('abastecimento_data_inicio');
            session()->forget('abastecimento_data_fim');
            session()->forget('abastecimento_colaborador_id');
            session()->forget('abastecimento_veiculo_id');
        }
        if(!is_null($request->Inicio)&&!is_null($request->Fim)){
            session(['abastecimento_data_inicio'=>$request->Inicio]);
            session(['abastecimento_data_fim'=>$request->Fim]);
        }
        if(session()->has('abastecimento_data_inicio') && session()->has('abastecimento_data_fim')){
            $abast->where('data','>=',session('abastecimento_data_inicio'))->where('data','<=',session('abastecimento_data_fim'));
        }
        if(!is_null($request->colaborador)){
            session(['abastecimento_colaborador_id'=>$request->Fim]);
            $abast->where('colaborador_id',$request->colaborador);
        }
        if(session()->has('abastecimento_colaborador_id')){
            $abast->where('colaborador_id',session('abastecimento_colaborador_id'));
        }
        if(!is_null($request->veiculo)){
            session(['abastecimento_veiculo_id'=>(int)$request->veiculo]);
        }
        if(session()->has('abastecimento_veiculo_id')){
            $abast->where('veiculo_id',session('abastecimento_veiculo_id'));
        }
        if((!empty($_GET['item']) && !empty($_GET['order']))){
            $abast->orderBy($_GET['item'],$_GET['order']);
            session(['abastecimento_order-by-items-item'=>$_GET['item'],'abastecimento_order-by-items-order'=>$_GET['order']]);
        }

        if(session()->has('abastecimento_order-by-items-item') && session()->has('abastecimento_order-by-items-order')){
            $abast->orderBy(session('abastecimento_order-by-items-item'),session('abastecimento_order-by-items-order'));
        }else{
            $abast->orderBy('id','desc');
        }
        $paginate = 5;
        if(!empty($_GET['paginate'])){
            $paginate = $_GET['paginate'];
            session(['abastecimento_paginate-by-page'=>$paginate]);
        }
        $dados = $abast->paginate($paginate);
        if(session()->has('abastecimento_paginate-by-page')){
            $paginate = session('abastecimento_paginate-by-page');
            $dados->appends($paginate);
            // dump(session('paginate-by-page'));
        }
        if(session()->has('order-by-items-item') && session()->has('order-by-items-order')){
            $item = session('order-by-items-item');
            $order = session('order-by-items-order');
            $dados->appends(['item'=>$item]);
            $dados->appends(['order'=>$order]);
            // dump(session('order-by-items-order'));
            // dump(session('order-by-items-item'));
        }
        // dd(session('order-by-items-order'));

        $dados = $abast->paginate($paginate)->withQueryString();
        // dd($dados);

        // foreach(Abastecimento::all() as $abastecimento){
        //     if($abastecimento->colaborador->usuario()->withTrashed()->get()->count()!=0){
        //         echo 'colaborador: '.  $abastecimento->colaborador->usuario()->withTrashed()->first()->name . '<br />';
        //     }else{
        //         echo 'colaborador: '.  $abastecimento->colaborador->usuario->first()->name . '<br />';
        //     }
        // }

        // return response()->json(Abastecimento::all());
        return view('veiculo.abastecimento.index',['Abastecimentos'=>$dados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!is_null(Auth::user()->tenant_id)){
            $fornecedor = Auth::user()->tenant->first()->fornecedor;
        }else{
            $fornecedor = Fornecedor::where('especialidade_id',1)->get();
        }
        // return view('fornecedor.index', ['fornecedores' => $fornecedor]);
        return view('veiculo.abastecimento.create',['fornecedores' => $fornecedor]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // throw new Exception('erro');
            $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));


            // return response()->json(['status'=>0,'msg'=>$request->input()]);
            $validator = Validator::make($request->all(),[
                'Cupom'=>'required|numeric',
                'Km'=>'required',
                'Litro'=>'required',
                'Valor'=>'required',
                'Combustivel'=>'required|numeric',
                'FotoCupom'=>'required',
                'FotoHodometro'=>'required',
                'FotoBomba'=>'required',
            ]);


            // $validator = $request->validate([
            //     'Cupom'=>'required|numeric',
            //     'Km'=>'required|numeric',
            //     'Litro'=>'required|numeric',
            //     'Valor'=>'required|numeric',
            //     'FotoCupom'=>'required',
            //     'FotoHodometro'=>'required',
            //     'FotoBomba'=>'required',
            // ]);
            $Cupom = $request->Cupom;
            $FotoCupom = $request->FotoCupom;
            $FotoHodometro = $request->FotoHodometro;
            $FotoBomba = $request->FotoBomba;
            $arrayFilesPermited = ["png","jpg","jpeg"];
            // dd($FotoCupom);


            if($validator->fails())
            {
                if(!is_null($request->ajax)){
                    // if(!is_null($erro['Cupom'])){
                    foreach($validator->errors()->all() as $erro){
                        throw new Exception($erro);
                    }
                    // }
                }

                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }

            // return response()->json(['status'=>200,'msg'=>'Abastecimento cadastrado com sucesso']);
            // exit;
            // $manager = new ImageManager(new Driver());

            // $sizeCupom = $FotoCupom->getSize()/1024;
            // $sizeHodometro = $FotoHodometro->getSize()/1024;
            // $sizeBomba = $FotoBomba->getSize()/1024;
            // $size = 5120;
            // if($sizeCupom>$size)
            // {
            //     throw new Exception('Tamanho de Arquivo não permitido. Foto do Cupom muito grande('.$sizeCupom.'kb). Maior que '.$size.'kb');
            // }


            // if($sizeBomba>$size)
            // {
            //     throw new Exception('Tamanho de Arquivo não permitido. Foto da Bomba muito grande('.$sizeBomba.'kb). Maior que '.$size.'kb');
            // }

            // if($sizeHodometro>$size)
            // {
            //     throw new Exception('Tamanho de Arquivo não permitido. Foto do Hodometro muito grande('.$sizeHodometro.'kb). Maior que '.$size.'kb');
            // }


            // if (!in_array($FotoCupom->getClientOriginalExtension(),$arrayFilesPermited)) {
            //     // echo $cupom->getClientOriginalExtension();
            //     throw new Exception('Adicione a foto do cupom fiscal');
            // }
            // if(!in_array($FotoHodometro->getClientOriginalExtension(),$arrayFilesPermited)){
            //     throw new Exception('adicione a foto do hodometro/velocimetro');
            // }
            // if(!in_array($FotoBomba->getClientOriginalExtension(),$arrayFilesPermited)){
            //     throw new Exception('adicione a foto da bomba de abastecimento');
            // }
            // $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));

            // Storage::put('app/public/' . $empresa . '/arquivos/notas/xml/' . $xml->NFe->infNFe->ide->nNF . '.xml', file_get_contents($file));
            // if(file_exists(getenv('RAIZ').'/public/uploads/abastecimento/put/'.$imageNameCupom)){
            //     // throw new Exception('existe');
            // }
            // Storage::putFileAs('app/public/'.$empresa.'/abastecimentos/put/'., new File('uploads/abastecimento/put/'.$imageNameCupom),$imageNameCupom);
            // throw new Exception(getenv('RAIZ').'/public/uploads/abastecimento/put/'.$imageNameCupom);
            // echo 'ola'.$cupom->getClientOriginalExtension();
            // exit;
            // return response()->json(['status'=>200,'msg'=>$request->input()]);

            DB::beginTransaction();
            $abastecimento = new Abastecimento();
            $abastecimento->newId();
            $abastecimento->cupom = $request->Cupom;
            $abastecimento->kmAtual = number_format((double)Uteis::validaNumero($request->Km),2,'.','');
            $abastecimento->litros = number_format((double)Uteis::validaNumero($request->Litro),2,'.','');
            $abastecimento->valor = number_format((double)Uteis::validaNumero($request->Valor),2,'.','');
            $abastecimento->combustivel_id = $request->Combustivel;
            $abastecimento->user_id = Auth::user()->id;

            // throw new Exception($abastecimento);
            if(count(Auth::user()->colaborador)!=0 && is_null($request->colaborador)){
                // echo Auth::user()->colaborador->first()->id;
                $abastecimento->colaborador_id = Auth::user()->colaborador->first()->id;
                // echo '<br />';
                // if(count(Auth::user()->colaborador->first()->veiculo)!=0){
                //     // echo Auth::user()->colaborador->first()->veiculo->first()->placa;
                //     $abastecimento->veiculo_id = Auth::user()->colaborador->first()->veiculo->first()->id;
                // }else{
                //     if(!is_null($request->veiculo)){
                //         $abastecimento->veiculo_id = $request->veiculo;
                //     }else{
                //         throw new Exception('Entre em contato com o responsavel identificando qual o veiculo que está abastecendo!');
                //     }
                // }
                if(!is_null($request->veiculo)){
                    $abastecimento->veiculo_id = $request->veiculo;
                }else{
                    if(count(Auth::user()->colaborador->first()->veiculo)!=0){
                        $abastecimento->veiculo_id = Auth::user()->colaborador->first()->veiculo->first()->id;
                    }else{
                        throw new Exception('Entre em contato com o responsavel identificando qual o veiculo que está abastecendo!');
                    }
                }
            }else{
                $abastecimento->veiculo_id = $request->veiculo;
                $abastecimento->colaborador_id = $request->colaborador;
                $abastecimento->tenant_id = Colaborador::find($request->colaborador)->tenant_id;
            }

            $Veiculo = Veiculo::find($abastecimento->veiculo_id);
            // throw new Exception($Veiculo);
            $kmAnterior = Abastecimento::where('veiculo_id',$abastecimento->veiculo_id)->get();
            $kmAnt = 1;
            if($kmAnterior->count()!=0){
                $kmAnt=$kmAnterior->last()->kmAtual;
            }else if($Veiculo->kms()->get()->count() != 0){
                $kmAnt = $Veiculo->kms->last()->km;
            }
            $abastecimento->kmAnterior = $kmAnt;

            $lastAbastecimento = $abastecimento->veiculo->kms()->get();
            if($lastAbastecimento->count()!=0){
                $ultimoAbastecimento = $lastAbastecimento->last()->km;
            }else{
                $ultimoAbastecimento = 1;
            }

            // $abastecimento->kmAnterior = ($kmAnterior->count()!=0)? $kmAnterior->last()->kmAtual : $Veiculo->kms->last()->km;
            // return $abastecimento->veiculo->kms()->get()->last()->km;
            // throw new Exception($abastecimento->veiculo->kms()->get()->last()->km);
            if(($abastecimento->kmAnterior>=$abastecimento->kmAtual) || ($ultimoAbastecimento > $abastecimento->kmAtual)){
                // if(!is_null($request->ajax)){
                    throw new Exception("erro: O km anterior não pode ser menor ou igual ao km atual. km digitado:".$abastecimento->kmAtual." ultimo km regitrado: ".$abastecimento->veiculo->kms()->get()->last()->km."
                     abastecimento anterior: ".$abastecimento->kmAnterior);
                // }else{
                //     return 'erro: O km anterior não pode ser menor ou igual ao km atual. km digitado: '.$abastecimento->kmAtual.
                //     ' ultimo km regitrado: '.$abastecimento->veiculo->kms()->get()->last()->km.
                //     ' abastecimento anterior: '.$abastecimento->kmAnterior;
                // }
            }
            // throw new Exception('erro');
            $KmModel = new Km();
            $KmModel->setKm($Veiculo,$abastecimento->kmAtual);
            $KmModel->save();
            $Veiculo->associaColaborador($abastecimento->colaborador_id);
            $abastecimento->Fornecedor_id = $request->Fornecedor;
            // return $abastecimento->getAttributes();

            // return 'salvo';
            $linux = false;


            //SALVAR AS FOTOS NO SERVIDOR

            $pathFileTo = 'app/public/'.$empresa.'/abastecimentos';
            if(!file_exists($pathFileTo) && $linux==true){
                mkdir($pathFileTo,0775, true);
            }
            $data = date('Y-m-d H-i-s');
            $abastecimento->data = $data;

            // throw new Exception($pathFileTo.'/'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension());
            // $path = Storage::disk('s3')->putFileAs(
            //     $pathFileTo,  $FotoCupom, 'Cupom_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension()
            // );
            // $abastecimento->pathFotoCupom = $FotoCupom->storeAS($pathFileTo,'Cupom_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension());
            // $abastecimento->pathFotoCupom = $FotoCupom->storeAS($pathFileTo,'Cupom_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension());
            // $abastecimento->pathFotoHodometro = $FotoHodometro->storeAS($pathFileTo,'Hodometro_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension());
            // $abastecimento->pathFotoBomba = $FotoBomba->storeAS($pathFileTo,'Bomba_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension());

            // $imageNameCupom = Str::uuid().$FotoCupom->getClientOriginalName();
            // $FotoCupom->move('uploads/abastecimento',$imageNameCupom);
            // $imageCupomRead = $manager->read('uploads/abastecimento/'.$imageNameCupom);
            // $imageCupomRead->scale(height:500)->save(public_path('uploads/abastecimento/put/'.$imageNameCupom));
            // $pathCupom = 'app/public/'.$empresa.'/abastecimentos/Cupom_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension();

            // Storage::put( $pathCupom,file_get_contents(getenv('RAIZ').'/public/uploads/abastecimento/put/'.$imageNameCupom));

            //criando pastas
            $path = getenv('RAIZ').'/storage/app/public/'.$empresa.'/';
            if(!file_exists($path.'uploads')){
                mkdir($path.'/uploads',777);
            }
            if(!file_exists($path.'uploads/abastecimentos')){
                mkdir($path.'/uploads/abastecimentos',777);
            }

            list($tipo, $FotoCupom)=explode(';',$FotoCupom);
            list($tipo, $FotoCupom)=explode(',',$FotoCupom);
            $imagemCupom = base64_decode($FotoCupom);
            $img_nome_cupom = $Cupom.'_'.time().'.png';
            file_put_contents($path.'/uploads/abastecimentos/'.$img_nome_cupom,$imagemCupom);
            $pathCupom = 'app/public/'.$empresa.'/abastecimentos/Cupom_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'_'.$img_nome_cupom;
            $abastecimento->pathFotoCupom =  $pathCupom ;
            Storage::put($pathCupom,file_get_contents( $path.'uploads/abastecimentos/'.$img_nome_cupom));
            // Storage::put($pathCupom,file_get_contents( $imagemCupom));


            list($tipo, $FotoHodometro)=explode(';',$FotoHodometro);
            list($tipo, $FotoHodometro)=explode(',',$FotoHodometro);
            $imagemHodometro = base64_decode($FotoHodometro);
            $img_nome_hodometro = $Cupom.'_'.time().'.png';
            file_put_contents($path.'/uploads/abastecimentos/'.$img_nome_hodometro,$imagemHodometro);
            $pathHodometro = 'app/public/'.$empresa.'/abastecimentos/Hodometro_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'_'.$img_nome_hodometro;
            $abastecimento->pathFotoHodometro =  $pathHodometro ;
            Storage::put($pathHodometro,file_get_contents( $path.'uploads/abastecimentos/'.$img_nome_hodometro));


            list($tipo, $FotoBomba)=explode(';',$FotoBomba);
            list($tipo, $FotoBomba)=explode(',',$FotoBomba);
            $imagemBomba = base64_decode($FotoBomba);
            $img_nome_bomba = $Cupom.'_'.time().'.png';
            file_put_contents($path.'/uploads/abastecimentos/'.$img_nome_bomba,$imagemBomba);
            $pathBomba = 'app/public/'.$empresa.'/abastecimentos/Bomba_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'_'.$img_nome_bomba;
            $abastecimento->pathFotoBomba =  $pathBomba ;
            Storage::put($pathBomba,file_get_contents( $path.'uploads/abastecimentos/'.$img_nome_bomba));

            // return response()->json(['status'=>0,'msg'=>'successo']);
            // $imageNameHodometro = Str::uuid().$FotoHodometro->getClientOriginalName();
            // $FotoHodometro->move('uploads/abastecimento',$imageNameHodometro);
            // $imageHodometroRead = $manager->read('uploads/abastecimento/'.$imageNameHodometro);
            // $imageHodometroRead->scale(height:500)->save(public_path('uploads/abastecimento/put/'.$imageNameHodometro));
            // $pathHodometro = 'app/public/'.$empresa.'/abastecimentos/Hodometro_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension();
            // $abastecimento->pathFotoHodometro = $pathHodometro;
            // Storage::put($pathHodometro,file_get_contents(getenv('RAIZ').'/public/uploads/abastecimento/put/'.$imageNameHodometro));

            // $imageNameBomba = Str::uuid().$FotoBomba->getClientOriginalName();
            // $FotoBomba->move('uploads/abastecimento',$imageNameBomba);
            // $imageBombaRead = $manager->read('uploads/abastecimento/'.$imageNameBomba);
            // $imageBombaRead->scale(height:500)->save(public_path('uploads/abastecimento/put/'.$imageNameBomba));
            // $pathBomba = 'app/public/'.$empresa.'/abastecimentos/Bomba_'.$abastecimento->cupom.'_'.$Veiculo->placa.'_'.$data.'.'.$FotoCupom->getClientOriginalExtension();
            // $abastecimento->pathFotoBomba = $pathBomba ;
            // Storage::put($pathBomba,file_get_contents(getenv('RAIZ').'/public/uploads/abastecimento/put/'.$imageNameBomba));


            $abastecimento->save();
            // echo '<pre>';
            // print_r($abastecimento->getAttributes());
            // echo '</pre>';
            //
            // throw new Exception($abastecimento->colaborador->id);

            // DB::commit();
            if(file_exists($path.'uploads/abastecimentos/'.$img_nome_cupom)){
                unlink($path.'uploads/abastecimentos/'.$img_nome_cupom);
            }
            if(file_exists($path.'uploads/abastecimentos/'.$img_nome_hodometro)){
                unlink($path.'uploads/abastecimentos/'.$img_nome_hodometro);
            }
            if(file_exists($path.'uploads/abastecimentos/'.$img_nome_bomba)){
                unlink($path.'uploads/abastecimentos/'.$img_nome_bomba);
            }


            // throw new Exception('ok');
            // if(!isset($request->ajax)){
                return response()->json(['status'=>200,'msg'=>'Abastecimento cadastrado com sucesso']);
            // }else{
                // return redirect()->route('abastecimento.index')->with(['message'=>['status'=>'success','msg'=>'abastecimento salvo com sucesso']]);
            // }
        }catch(Exception $ex){
            DB::rollback();
            // return $ex->getMessage(). '-'.$ex->getFile().'-'.$ex->getLine();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
            // return response()->json(['status'=>0,'msg'=>'Erro: '.$ex->getMessage(). '-'.$ex->getFile().'-'.$ex->getLine()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $abastecimento = Abastecimento::where('id',$id)->get()->first();

        if(Auth::user()->roles()->first()->name== 'tenant-colaborador' || Auth::user()->roles()->first()->name== 'colaborador'){
            // $abast = Abastecimento::orderBy('id','desc')->where('colaborador_id',Auth::user()->colaborador->first()->id)->with('veiculo','colaborador');
            $abast = Abastecimento::orderBy('id','desc')->where('colaborador_id',Auth::user()->colaborador->first()->id)->where('id',$id)->with('veiculo','colaborador')->get()->first();
        }else{
            $abast = Abastecimento::find($id);
        }

        if($abast->count()==0){
            return redirect()->route('dashboard')->with(['message'=>['status'=>'danger','msg'=>'Acesso não permitido']]);
        }
        return view('veiculo.abastecimento.show',['abastecimento'=>$abast]);
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

    public function getRanking()
    {
        $Abastecimentos = Abastecimento::selectRaw('((kmAtual-kmAnterior)/litros) as media, colaborador_id, veiculo_id')->orderBy('media','desc')->with('veiculo','colaborador')->get()->unique('colaborador_id');
        // $Tucks = Abastecimento::selectRaw('((kmAtual-kmAnterior)/litros) as media, colaborador_id, veiculo_id')->orderBy('media','desc')->with('veiculo','colaborador')->get()->unique('colaborador_id');
        // $url = Storage::temporaryUrl(
        //     $abast->pathFotoCupom, now()->addMinutes(5)
        // );
        // $url = Storage::url( $abast->pathFotoCupom);
        // return response()->json(['status'=>200,'msg'=>$url]);
        return view('veiculo.abastecimento.ranking',['Abastecimentos'=>$Abastecimentos]);
    }
}
