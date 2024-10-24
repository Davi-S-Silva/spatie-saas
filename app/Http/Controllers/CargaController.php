<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\DistanceCity;
use App\Models\Empresa;
use App\Models\Entrega;
use App\Models\FileCarga;
use App\Models\Filial;
use App\Models\Historico;
use App\Models\Km;
use App\Models\LocalApoio;
use App\Models\LocalMovimentacao;
use App\Models\ModeloUmFrete;
use App\Models\MovimentacaoVeiculo;
use App\Models\Nota;
use App\Models\PdfsSistema;
use App\Models\ProdutoNota;
use App\Models\Status;
use App\Models\Uteis;
use App\Models\Veiculo;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CargaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Deletar Carga', only: ['destroy']),
            new Middleware('permission:Listar Carga', only: ['index']),
            new Middleware('permission:Show Carga', only: ['show']),
            new Middleware('permission:Editar Carga', only: ['edit', 'update']),
            new Middleware('permission:Criar Carga', only: ['create', 'store']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carga =  Carga::with('veiculo', 'entregas', 'notas', 'notas.filial', 'notas.status', 'notas.destinatario', 'notas.destinatario.endereco');
        if (Auth::user()->roles()->first()->name == 'tenant-colaborador' || Auth::user()->roles()->first()->name == 'colaborador') {
            $carga->where('motorista_id', Auth::user()->id);
        }
        if(!is_null($request->Reset)){
            session()->forget('order-by-items-item');
            session()->forget('order-by-items-order');
            session()->forget('carga_paginate-by-page');
            session()->forget('carga_data_inicio');
            session()->forget('carga_data_fim');
            session()->forget('carga_colaborador_id');
            session()->forget('carga_veiculo_id');
            session()->forget('carga_origem');
            session()->forget('carga_status');
            session()->forget('carga_diarias');
            session()->forget('carga_NumeroDoc');
        }

        // dump($request->input());
        if(!is_null($request->Inicio)&&!is_null($request->Fim)){
            session(['carga_data_inicio'=>$request->Inicio]);
            session(['carga_data_fim'=>$request->Fim]);
        }
        if(session()->has('carga_data_inicio') && session()->has('carga_data_fim')){
            $carga->where('data','>=',session('carga_data_inicio'))->where('data','<=',session('carga_data_fim'));
        }
        if(!is_null($request->colaborador)){
            session(['carga_colaborador_id'=>$request->colaborador]);
        }
        if(session()->has('carga_colaborador_id')){
            $carga->where('motorista_id',session('carga_colaborador_id'));
        }
        if(!is_null($request->veiculo)){
            session(['carga_veiculo_id'=>$request->veiculo]);
        }
        if(session()->has('carga_veiculo_id')){
            $carga->where('veiculo_id',session('carga_veiculo_id'));
        }
        if(!is_null($request->origem)){
            session(['carga_origem'=>$request->origem]);
        }
        if(session()->has('carga_origem')){
            $carga->where('filial_id',session('carga_origem'));
        }

        if(!is_null($request->status)){
            session(['carga_status'=>(int)$request->status]);
        }
        if(session()->has('carga_status')){
            $carga->where('status_id',session('carga_status'));
        }
        if(!is_null($request->NumeroDoc)){
            session(['carga_NumeroDoc'=>(int)$request->NumeroDoc]);
        }
        if(session()->has('carga_NumeroDoc')){
            $carga->where('remessa','like','%'.session('carga_NumeroDoc').'%')->orwhere('os','like','%'.session('carga_NumeroDoc').'%');
        }
        if(!is_null($request->diaria)){
            session(['carga_diarias'=>1]);
        }
        if(session()->has('carga_diarias')){
            $carga->where('diaria','>=',session('carga_diarias'));
        }
        if((!empty($_GET['item']) && !empty($_GET['order']))){
            $carga->orderBy($_GET['item'],$_GET['order']);
            session(['order-by-items-item'=>$_GET['item'],'order-by-items-order'=>$_GET['order']]);
        }else{
            $carga->orderBy('id','desc');
            session(['order-by-items-item'=>'id','order-by-items-order'=>'desc']);
        }

        if(session()->has('order-by-items-item') && session()->has('order-by-items-order')){
            $carga->orderBy(session('order-by-items-item'),session('order-by-items-order'));
        }
        $paginate = 15;
        if(!empty($_GET['paginate'])){
            $paginate = $_GET['paginate'];
            session(['carga_paginate-by-page'=>$paginate]);
        }
        $dados = $carga->paginate($paginate);
        if(session()->has('carga_paginate-by-page')){
            $paginate = session('carga_paginate-by-page');
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



        $Carga = $carga->paginate($paginate)->withQueryString();
        $statusAll = (new Carga())->getAllStatus();
        return view('carga.index', ['cargas' => $Carga,'statusAll'=>$statusAll]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        // $disabled = ($clientes->count()==0)?'disabled':'';

        // return view('carga.create',['clientes'=>$clientes,'disabled'=>$disabled,'link'=>'clientes.create','text'=>'Não há clientes cadastrados']);
        return view('carga.create', ['clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return response()->json('teste');
        try {
            $CargaBD = Carga::where('remessa', $request->remessa)->where('os', $request->os)->get();
            if ($CargaBD->count() != 0) {
                throw new Exception('Carga já Cadastrada no Sistema');
            }
            if(!is_null($request->veiculo)){
                $CargaVeiculo = Carga::where('veiculo_id',$request->veiculo)->where('status_id',"!=",(new Carga())->getStatusId('Finalizada'))->get();
                // $veiculo = Veiculo::find($request->veiculo);
                // if($request->veiculo == '' || is_null($request->veiculo)){
                //     throw new Exception ('Selecione o veiculo da Carga');
                // }
                // if($CargaVeiculo->count()!=0 && $veiculo->placa != 'KKD1244'){
                //     throw new Exception('Existe Carga não finalizada para esse veiculo no Sistema');
                // }
                if($CargaVeiculo->count()!=0){
                    throw new Exception('Existe Carga não finalizada para esse veiculo no Sistema');
                }

            }

            if(is_null($request->data)){
                throw new Exception('Informe a data de emissão da carga');
            }
            if(is_null($request->agenda)){
                throw new Exception('Informe a data de agendamento da carga para o cliente');
            }
            DB::beginTransaction();
            $carga = new Carga();
            $carga->newId();
            $carga->destino = $request->area;
            $carga->motorista_id = $request->colaborador;
            $carga->remessa = $request->remessa;
            $carga->veiculo_id = $request->veiculo;
            $carga->frete = Uteis::validaNumero($request->frete);
            $carga->os = $request->os;
            $carga->data = $request->data;
            $carga->agenda = $request->agenda;
            $carga->cliente_id = Filial::find($request->Filial)->clientes()->first()->id;
            $carga->filial_id = $request->Filial;
            $carga->empresa_id = LocalApoio::find($request->empresa_local_apoio_id)->empresa->id;
            $carga->local_apoio_id = $request->empresa_local_apoio_id;
            $carga->usuario_id = Auth::user()->id;
            $carga->setStatus('Pendente'); //carga pendente

            $carga->save();

            // $carga->setNotas($request->Notas);


            $msg = "Carga ".$carga->remessa." cadastrada com sucesso por ".Auth::user()->name." - data: ".date('d/m/Y H:i:s');
            $historico = new Historico();
            $historico->newId();
            $historico->model = 'Carga';
            $historico->id_model = $carga->id;
            $historico->descricao = $msg;
            $historico->dados = $carga;
            $historico->data = date('Y-m-d');
            $historico->user_id = Auth::user()->id;
            $historico->tenant_id = Auth::user()->tenant_id;
            $historico->save();

            // $carga->save();

            DB::commit();
            Log::info("message");
            return response()->json(['status' => 'success', 'carga' => $carga, 'msg' => 'Carga Cadastrada com Sucesso']);
            // return response()->json([$request->input(),(new Nota())->getNotas($request->Notas, $request->Filial, )]);
        } catch (Exception $ex) {
            DB::rollback();
            // return response()->json([$ex->getMessage(),$ex->getLine()]);
            // return response()->json(['status'=>'danger','msg'=>$ex->getMessage(). '-'.$ex->getFile().'-'.$ex->getLine()]);
            return response()->json(['status' => 'danger', 'msg' => $ex->getMessage()]);
        }



        // return response()->json($request->input());
        // return response()->json($request->input());
    }

    /**
     * Display the specified resource.
     */
    public function show(Carga $carga)
    {
        // $Carga = Carga::find($carga->id)->with('filial')->get()->first();
        return view('carga.show', ['carga' => $carga]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carga $carga)
    {
        $clientes = Cliente::all();
        return view('carga.edit', ['carga' => $carga,'clientes' => $clientes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carga $carga)
    {
        try{
            $carga->destino = $request->area;
            $carga->motorista_id = $request->colaborador;
            $carga->remessa = $request->remessa;
            $carga->veiculo_id = $request->veiculo;
            $carga->frete = Uteis::validaNumero($request->frete);
            $carga->os = $request->os;
            $carga->data = $request->data;
            $carga->agenda = $request->agenda;
            $carga->cliente_id = Filial::find($request->Filial)->clientes()->first()->id;
            $carga->filial_id = $request->Filial;
            $carga->empresa_id = LocalApoio::find($request->empresa_local_apoio_id)->empresa->id;
            $carga->local_apoio_id = $request->empresa_local_apoio_id;
            $carga->usuario_id = Auth::user()->id;
            $carga->save();

            $msg = "Carga ".$carga->remessa." editada com sucesso por ".Auth::user()->name." - data: ".date('d/m/Y H:i:s');
            $historico = new Historico();
            $historico->newId();
            $historico->model = 'Carga';
            $historico->id_model = $carga->id;
            $historico->descricao = $msg;
            $historico->dados = $carga;
            $historico->data = date('Y-m-d');
            $historico->user_id = Auth::user()->id;
            $historico->tenant_id = Auth::user()->tenant_id;
            $historico->save();
            return response()->json(['status'=>200,'msg'=>'Carga editada com sucesso']);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);

        }
        // return response()->json($request->input());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carga $carga)
    {
        //
    }
    public function formDiaria(Carga $carga)
    {
        return view('carga.addDiaria',['carga'=>$carga]);
    }
    public function storeFormDiaria(Carga $carga, Request $request)
    {
        try{
            DB::beginTransaction();
            if($carga->status_id == $carga->getStatusId('Pendente') || $carga->status_id == $carga->getStatusId('Aguardando')){
                throw new Exception('Não é permitido modificar diaria de carga não iniciada a entrega');
            }
            // return response()->json(['status'=>200,'msg'=>$request->input()]);
            if($request->diaria<0){
                throw new Exception('Não é permitido valor de diaria negativo');
            }
            $carga->diaria = $request->diaria;
            $carga->save();
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Diaria editada com sucesso','diaria'=>$carga->diaria,'carga'=>$carga->id]);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage(). '-'.$ex->getFile().'-'.$ex->getLine()]);
        }
    }
    public function setNotas(Request $request, $carga)
    {
        try {
            DB::beginTransaction();
            $Carga = Carga::find($carga);
            if(is_null($Carga->motorista_id)){
                throw new Exception('Para Add notas na carga informe o motorista que vai efetuar o carregamento da carga');
            }
            if(is_null($Carga->remessa)){
                throw new Exception('Para Add notas na carga informe o numero de remessa');
            }
            if(is_null($Carga->os)){
                throw new Exception('Para Add notas na carga informe o numero de remessa');
            }

            if(is_null($Carga->veiculo_id)){
                throw new Exception('Para Add notas na carga informe o veiculo que vai efetuar o carregamento da carga');
            }
            if ($Carga->getStatusId('Pendente') != $Carga->status_id) {
                throw new Exception('Não é possivel adicionar nota a uma carga ja esteja em rota ou finalizada');
            }
            if (is_null($request->Notas)) {
                throw new Exception('Digite as notas a serem inseridas');
            }
            // $request->validate([
            //     'Notas'=>'required|alpha_dash'
            // ]);
            // $array =   Uteis::limpar_texto(str_replace('Número: ', '', $request->Notas));
            $array =   Uteis::limpar_texto($request->Notas);
            $response = $Carga->setNotas($array);

            if (is_null($response)) {
                throw new Exception('Verifique as informações digitadas');
            }

            // sleep(5);
            if (count($response) != 0) {
                return response()->json(['status' => 0, 'msg' => 'notas nao encontradas', 'notas' => $response]);
            }
            // return response()->json(['status'=>200,'msg'=>$response]);
            DB::commit();
            return response()->json(['status' => 200, 'msg' => 'Notas Cadastradas com sucesso!']);
        } catch (Exception $ex) {
            DB::rollback();
            // return ['status'=>0,'msg' => $ex->getMessage().' - '. $ex->getCode().' - file '.$ex->getFile().' - line '.$ex->getLine()];
            return response()->json(['status'=>0,'msg' => $ex->getMessage().' - '. $ex->getCode().' - file '.$ex->getFile().' - line '.$ex->getLine()]);
            // return ['status' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function getCargasDisponiveis($filial)
    {
        try {


            $Filial = Filial::where('link', $filial)->get();

            if ($Filial->count() == 0) {
                throw new Exception('Cargas não encontradas para cliente ' . $filial);
            }
            $cargas = $Filial->first()->cargas;
            // return response()->json(['Cliente'=>$filial->clientes()->first()->name]);
            $Dados = [];
            foreach ($cargas as $carga) {
                if ($carga->status_id == 1) {
                    $Dados[] = [
                        'id' => $carga->id,
                        'destino' => $carga->destino,
                        'remessa' => $carga->remessa,
                        'os' => $carga->os,
                        'motorista' => $carga->motorista->name,
                        'placa' => $carga->veiculo->placa,
                        'data' => date('d/m/Y', strtotime($carga->data))
                    ];
                }
            }

            // $cargas = $filial->with('cargas')->get();

            // dd($Dados);
            return response()->json(['status' => 200, 'cargas' => $Dados, 'cliente' => $Filial->first()->nome_fantasia]);
        } catch (Exception $ex) {
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
        }
    }

    public function cidadeFrete($carga)
    {
        try {
            DB::beginTransaction();
            $maior = array();
            $Carga = Carga::find($carga);

            $cliente  = Cliente::find($Carga->cliente_id);



            // if (!is_null($Carga->frete) && $Carga->frete != 0) {
            //     throw new Exception('Frete já calculado! Não é possivel calcular novamente!');
            // }

            foreach ($Carga->cidades() as $cidade) {
                $distancia = (new DistanceCity($cidade->getCoordenadas($Carga->filial->enderecos->first()->cidade->codigo), "$cidade->longitude,$cidade->latitude"))->showDistance();
                array_push($maior, [$distancia, $cidade]);
            }
            sort($maior);
            $CidadeFinal = end($maior)[1];
            $destino = $CidadeFinal->nome . ', ' . $CidadeFinal->estado->uf;
            $Carga->destino = $destino;
            // $modelUmFrete = ModeloUmFrete::where('cidades','like',"%alemana%")->get();

            $pesoCarga = $Carga->peso();
            if ($cliente->frete()->count() != 0) {
                // $frete = Frete::find($id);
                $nameModel = str_replace(' ','',ucwords(str_replace('-',' ',$cliente->frete->first()->name)));
                // echo $test = ucwords($model);
                $nameSpaceModel = '\\App\\Models\\'.$nameModel;
                if($nameModel=='ModeloUmFrete'){
                    $modelUmFrete = $nameSpaceModel::where('cidades', 'like', "%" . $CidadeFinal->nome . "%")->get();
                    if ($modelUmFrete->count() == 0) {
                        throw new Exception('Cidade não encontrada');
                    }
                    $modeloUmFrete = $modelUmFrete->first();
                    $pesoCalculo = 0;
                    if ($pesoCarga > 0 && $pesoCarga < 17000) {
                        $pesoCalculo = 14;
                    }
                    if($pesoCarga > 17000 && $pesoCarga < 28000){
                        $pesoCalculo = 28;
                    }
                    if($pesoCarga > 28000 ){
                        $pesoCalculo = 30;
                    }
                    $qtdEntregas = count($Carga->paradas());
                    $preco = 0;
                    if ($qtdEntregas == 1) {
                        $preco = $modeloUmFrete->um;
                    } elseif ($qtdEntregas == 2 || $qtdEntregas == 3) {
                        $preco = $modeloUmFrete->dois;
                    } elseif ($qtdEntregas == 4 || $qtdEntregas == 5) {
                        $preco = $modeloUmFrete->tres;
                    } elseif ($qtdEntregas == 6 || $qtdEntregas == 7) {
                        $preco = $modeloUmFrete->quatro;
                    } elseif ($qtdEntregas >= 8 && $qtdEntregas <= 10) {
                        $preco = $modeloUmFrete->cinco;
                    } elseif ($qtdEntregas >= 11 && $qtdEntregas <= 13) {
                        $preco = $modeloUmFrete->seis;
                    } elseif ($qtdEntregas >= 14 && $qtdEntregas <= 16) {
                        $preco = $modeloUmFrete->sete;
                    } elseif ($qtdEntregas >= 17 && $qtdEntregas <= 19) {
                        $preco = $modeloUmFrete->oito;
                    } elseif ($qtdEntregas >= 20 && $qtdEntregas <= 23) {
                        $preco = $modeloUmFrete->nome;
                    } else {
                        $preco = $modeloUmFrete->dez;
                    }

                    $valorFrete = ($pesoCalculo * $preco);
                    $Carga->frete = $valorFrete;
                    // return response()->json(['status' => 200, 'msg' => $valorFrete]);
                }


                // $cidade->getCoordenadas($carga->filial->enderecos->first()->cidade->codigo);

            }else{
                $valorFrete=0;
            }
            $Carga->save();
            DB::commit();
            return response()->json(['status' => 200, 'msg' => ['cidade' => $destino, 'frete' => number_format($valorFrete, 2, ',', '.')]]);
            // return response()->json(['status' => 200, 'msg' => end($maior)[1]]);
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
        }
    }

    public function gerarListaDevolucao(Carga $carga)
    {
        try {

            $dados = [];
            $totalItens = 0;
            $devolvidas = $carga->notasPorStatus('Devolvida');

            // echo '<pre>';
            // echo 'Notas Devolvidas: '.$devolvidas->count();
            // echo '<br />';

            foreach ($devolvidas as $nota) {
                $dados['dados']['totalItens'] = $totalItens += $nota->volume;
                $dados['dados']['remessa'] = $carga->remessa;
                $dados['dados']['os'] = $carga->os;
                $dados['dados']['carga'] = $carga->id;
                // $dados['dados']['precarga'] = $carga->precarga;
                $dados['notas'][$nota->nota]['nota'] = (object)$nota;
                // $dados['notas'][$nota->nota]['destinatario'] = (object)DestinatarioNota::find($nota->destinatario)->getAttributes();
                // print_r($nota->produtos()->count());
                // echo 'Nota: '.$nota->nota;
                // echo '<br />';
                foreach ($nota->produtos as $produto) {
                    // print_r($produto->getAttributes());
                    $dados['notas'][$nota->nota]['produtos'][] = (object)ProdutoNota::find($produto->id)->getAttributes();
                }
                // echo '<hr />';
            }
            // echo '</pre>';
            PdfsSistema::listaDevolucao($dados);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function gerarListaComprovante(Carga $carga)
    {
        try {
            $pagamentos = [
                1,//dinheiro
                3,//credito
                4,//debito
            ];
            $entregue = $carga->notasPorStatus('Entregue');
            $semTaNoBd = false;
            return view('carga.comprovantes',['notas'=>$entregue,'carga'=>$carga,'pagamentos'=>$pagamentos,'semTaNoBd'=>$semTaNoBd]);
            // PdfsSistema::listaDevolucao($dados);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function uploadCarga(Request $request, $carga)
    {
        try{
            DB::beginTransaction();
            $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));
            $Carga = Carga::find($carga);
            $TipoFileCarga = $request->TipoFileCarga;
            $TipoPermitido = ['Assinante','OS','Descarrego','AcessoArea','Canhotos','Devolucao'];
            if(!in_array($TipoFileCarga, $TipoPermitido)){
                throw new Exception('Tipo de arquivo não permitido');
            }
            if(is_null($Carga)){
                throw new Exception('Carga não encontrada');
            }
            $permitidos =['jpg','jpeg','pdf'];
            $file = $request->file('File'.$TipoFileCarga);
            if(is_null($file)){
                throw new Exception('Selecione um Arquivo');
            }
            $ext = $file->getClientOriginalExtension();
            if(!in_array($ext, $permitidos)){
                throw new Exception('formato de arquivo não permitido');
            }
            $name = $TipoFileCarga;
            if($TipoFileCarga=='Canhotos'){
                $explode = explode('.',$file->getClientOriginalName());
                $name .= '_'.$explode[0];
            }
            $name.='_'.$Carga->remessa.'_'.$Carga->os.'.'.$ext;
            $path = $file->storeAs('app/public/'.$empresa.'/arquivos/cargas/'.$TipoFileCarga,$name);
            if($path){
                $FileCarga = new FileCarga();
                $FileCarga->newId();
                $FileCarga->tipo =$TipoFileCarga;
                $FileCarga->name =$name;
                $FileCarga->path =$path;
                $FileCarga->carga_id =$carga;
                $FileCarga->user_id =Auth::user()->id;
                $FileCarga->save();
            }else{
                throw new Exception('Não foi possivel salvar o arquivo. sem permissao no storage, verifique as keys permissions');
            }

            DB::commit();
            // return response()->json(['request'=>$file->getClientOriginalExtension(),'carga'=>$carga]);
            return response()->json(['request'=>$request->input(),'carga'=>$carga,'path'=>$path]);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }
    public function UpdateStatusCarga(Carga $carga, Request $request)
    {
        try{
        DB::beginTransaction();
        if($carga->status_id == $carga->getStatusId('Finalizada')){
            throw new Exception('não é possivel atualizar o status de carga ja finalizada');
        }
        // $carga->status_id = $carga->getStatusId($request->status);
        // $carga->save();
        if($carga->notas()->get()->count()==0){
            throw new Exception('Inserir Notas na carga ' . $carga->remessa .' - ' . $carga->os);
        }
        $carga->setStatus($request->status);
        $carga->save();
        // DB::commit();
        return response()->json(['status'=>200,'msg'=>$request->status,'carga'=>$carga->id]);
        // dd($request->input());
    }catch(Exception $ex){
        DB::rollback();
        return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
    }

    }

    public function SeguirViagem(Carga $carga, Request $request){
        DB::beginTransaction();
        try{
            if($carga->status_id == $carga->getStatusId("Rota")){
                // throw new Exception('Carga já em Rota para o ');
                throw new Exception('Carga já em Rota para o Cliente');
            }
            $partida = LocalMovimentacao::where('title',Filial::find($carga->cliente_id)->razao_social)->first()->id;
            $km = (int)$request->Km;


            if(is_null($request->Destino)){
                throw new Exception('Destino Ínvalido');
            }
            $lastMovVeiculo = MovimentacaoVeiculo::where('veiculo_id',$carga->veiculo_id)->get();
            // return response()->json(['status'=>200, 'msg'=>$request->input(),'id'=>LocalMovimentacao::where('title',$request->Destino)->first()->id.'='.LocalMovimentacao::find($lastMovVeiculo->last()->Local_destino_id)->descricao]);
            if($lastMovVeiculo->count()!=0){
                if($lastMovVeiculo->last()->Local_destino_id == LocalMovimentacao::where('title',($request->Destino=='Cliente')?'Rota':$request->Destino)->first()->id){
                    throw new Exception('Movimentacao incorreta. o veiculo já está atualmente em '.LocalMovimentacao::find($lastMovVeiculo->last()->Local_destino_id)->title.'.');
                }
                if($lastMovVeiculo->last()->status_id!=$lastMovVeiculo->last()->getStatusId('Finalizada')){
                    throw new Exception('Existe movimentação não concluida para o veiculo');
                }
            }
            $Veiculo = Veiculo::find($carga->veiculo_id);
            $Motorista = Colaborador::find($carga->motorista_id);

            //criar Entrega
            if($request->Destino == 'Cliente'){
                //criar nova entrega junto com a movimentacao e ja iniciar
                $destino = LocalMovimentacao::where('title','Rota')->first()->id;
                $entrega = new Entrega();
                $entregaBd = Entrega::where('veiculo_id',$carga->veiculo_id)->where('status_id','!=',$entrega->getStatusId('Finalizada'))->get();
                if($entregaBd->Count()!=0){
                    throw new Exception('Existe entrega não finalizada para esse veiculo');
                }
                $entregaBd = Entrega::where('colaborador_id',$carga->motorista_id)->where('status_id','!=',$entrega->getStatusId('Finalizada'))->get();
                if($entregaBd->Count()!=0){
                    throw new Exception('Existe entrega não finalizada para esse Motorista');
                }
                $entrega->newId();
                $entrega->cliente_id = $carga->cliente_id;
                $entrega->filial_id = $carga->filial_id;
                $entrega->empresa_id = $carga->empresa_id;
                $entrega->local_apoio_id = $carga->local_apoio_id;

                if ($Veiculo->status_id == $Veiculo->getStatusId('Disponivel')) {
                    $entrega->veiculo_id = $carga->veiculo_id;
                } else {
                    throw new Exception('Veiculo está indisponivel');
                }
                $Veiculo->setStatus('Rota'); //veiculo indisponivel
                $Veiculo->save();
                if ($Motorista->status_id == $Motorista->getStatusId('Disponivel')) {
                    $entrega->colaborador_id = $carga->motorista_id;
                } else {
                    throw new Exception('Motorista está indisponivel ');
                }
                $Motorista->status_id = $Motorista->getStatusId('Rota');
                $Motorista->save();

                $entrega->setStatus('Rota'); //entrega pendente
                $entrega->usuario_id = Auth::user()->id;
                $entrega->save();

                $carga->setStatus('Rota');
                $entrega->cargas()->attach($carga);

                $Mov = new MovimentacaoVeiculo();
                $Mov->newId();
                $Mov->Local_partida_id = $partida;
                $Mov->Local_destino_id = LocalMovimentacao::where('title','Rota')->first()->id;
                $Mov->colaborador_id = $entrega->colaborador_id;
                $Mov->veiculo_id = $entrega->veiculo_id;
                $Mov->descricao = LocalMovimentacao::where('title','Rota')->first()->descricao . ' do cliente: ' . strtoupper($entrega->filial->nome_fantasia);
                $Mov->data_hora_inicio = date('Y-m-d H:i:s');
                $Mov->usuario_id = Auth::user()->id;
                $Mov->usuario_start_id = Auth::user()->id;
//  return response()->json(['status'=>200, 'msg'=>$request->input(),'km'=>$km]);
                $KmModel = new Km();
                $KmModel->setKm($Veiculo, $km);
                $KmModel->save();

                $Mov->km_inicio_id = $KmModel->id;
                $Mov->setStatus('Rota'); //movimentacao iniciada
                $Mov->save();

                $entrega->movimentacao_id = $Mov->id;
                $entrega->save();
                $msg = ['msg'=>'Movimentacao em rota para o cliente','entrega'=>$entrega->id];
            }else{
                //cria movimentacao para o Local escolhido "diferente do cliente"

                $destino = LocalMovimentacao::where('title',$request->Destino)->first();
                $Mov = new MovimentacaoVeiculo();
                $Mov->newId();
                $Mov->Local_destino_id = $destino->id;
                $Mov->Local_partida_id = $partida;
                $Mov->colaborador_id = $carga->motorista_id;
                $Mov->veiculo_id = $carga->veiculo_id;
                $Mov->usuario_id = Auth::user()->id;
                $Mov->descricao = 'Seguir para '.$destino->descricao;
                $Mov->data_hora_inicio = date('Y-m-d H:i:s');
                $Mov->setStatus('Pendente');//movimentacao pendente
                // $Mov->save();

                //Atualizar status para Aguardando -> aguardando iniciar entrega para seguir rota
                //movimentado para o local de espera para serguir outro dia para o cliente
                $carga->setStatus('Aguardando');
                $KmModel = new Km();
                $KmModel->setKm($Veiculo, $km);
                $KmModel->save();

                $Mov->km_inicio_id = $KmModel->id;
                $Mov->setStatus('Rota'); //movimentacao iniciada
                $Mov->save();
                $msg = ['msg'=>'Movimentacao para '.$request->Destino.' iniciada com sucesso','mov'=>$Mov->id];
            }
                $msgH = "Carga ".$carga->remessa." Atualizada com sucesso por ".Auth::user()->name." - data: ".date('d/m/Y H:i:s');
                $carga->setHistorico($msgH);
                $carga->save();

            DB::commit();
            return response()->json(['status'=>200, 'msg'=>$msg]);
        }catch(Exception $ex){
            DB::rollback();
            return response()->json(['status'=>0, 'msg'=>$ex->getMessage().'-'.$ex->getLine()]);
        }
    }

}
