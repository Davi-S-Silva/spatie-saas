<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use App\Models\Cliente;
use App\Models\DistanceCity;
use App\Models\Empresa;
use App\Models\Filial;
use App\Models\LocalApoio;
use App\Models\ModeloUmFrete;
use App\Models\Nota;
use App\Models\PdfsSistema;
use App\Models\ProdutoNota;
use App\Models\Uteis;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carga = Carga::with('veiculo','entregas','motorista','notas','notas.filial','notas.status','notas.destinatario','notas.destinatario.endereco'
        ,'notas.destinatario.endereco.cidade','notas.destinatario.endereco.estado')->orderBy('id','desc')->paginate(15);
        return view('carga.index', ['cargas' => $carga]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        // $disabled = ($clientes->count()==0)?'disabled':'';

        // return view('carga.create',['clientes'=>$clientes,'disabled'=>$disabled,'link'=>'clientes.create','text'=>'Não há clientes cadastrados']);
        return view('carga.create',['clientes'=>$clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return response()->json('teste');
        try {
            $CargaBD = Carga::where('remessa',$request->remessa)->where('os',$request->os)->get();
            if($CargaBD->count()!=0){
                throw new Exception('Carga já Cadastrada no Sistema');
            }
            DB::beginTransaction();
            $carga = new Carga();
            $carga->newId();
            $carga->destino = $request->area;
            $carga->peso =  Uteis::validaNumero($request->peso);
            $carga->entregas = $request->entregas;
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
            $carga->setStatus('Pendente');//carga pendente

            $carga->save();

            // $carga->setNotas($request->Notas);



            // $carga->save();

            DB::commit();
            return response()->json(['status'=>'success','carga'=>$carga,'msg'=>'Carga Cadastrada com Sucesso']);
            // return response()->json([$request->input(),(new Nota())->getNotas($request->Notas, $request->Filial, )]);
        } catch (Exception $ex) {
            DB::rollback();
            // return response()->json([$ex->getMessage(),$ex->getLine()]);
            return response()->json(['status'=>'danger','msg'=>$ex->getMessage()]);
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
        return view('carga.show',['carga'=>$carga]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carga $carga)
    {
        return view('carga.edit', ['carga' => $carga]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carga $carga)
    {
        return response()->json($request->input());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carga $carga)
    {
        //
    }

    public function setNotas(Request $request, $carga)
    {
        try {
            DB::beginTransaction();
            $Carga = Carga::find($carga);
            if($Carga->getStatusId('Pendente')!=$Carga->status_id){
                throw new Exception('Não é possivel adicionar nota a uma carga ja esteja em rota ou finalizada');
            }
            if(is_null($request->Notas)){
                throw new Exception('Digite as notas a serem inseridas');
            }
            // $request->validate([
            //     'Notas'=>'required|alpha_dash'
            // ]);
            // $array =   Uteis::limpar_texto(str_replace('Número: ', '', $request->Notas));
            $array =   Uteis::limpar_texto($request->Notas);
            $response = $Carga->setNotas($array);

            if(is_null($response)){
                throw new Exception('Verifique as informações digitadas');
            }

            // sleep(5);
            if(count($response)!=0){
                return response()->json(['status'=>0,'msg'=>'notas nao encontradas','notas'=>$response]);
            }
            // return response()->json(['status'=>200,'msg'=>$response]);
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Notas Cadastradas com sucesso!']);
        } catch (Exception $ex) {
            DB::rollback();
            // return ['status'=>0,'msg' => $ex->getMessage().' - '. $ex->getCode().' - file '.$ex->getFile().' - line '.$ex->getLine()];
            return ['status'=>0,'msg' => $ex->getMessage()];
        }
    }


    public function getCargasDisponiveis($filial)
    {
        try {


            $Filial = Filial::where('link', $filial)->get();

            if ($Filial->count() == 0) {
                throw new Exception('Cargas não encontradas para cliente '. $filial);
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
                        'motorista' => $carga->motorista->name
                    ];
                }
            }

            // $cargas = $filial->with('cargas')->get();

            // dd($Dados);
            return response()->json(['status' => 200, 'cargas' => $Dados,'cliente'=>$Filial->first()->nome_fantasia]);
        } catch (Exception $ex) {
            return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
        }

    }
        public function cidadeFrete($carga)
        {
            try{
                DB::beginTransaction();

                    $maior = array();
                    $Carga = Carga::find($carga);
                    if(!is_null($Carga->frete) && $Carga->frete !=0){
                        throw new Exception('Frete já calculado! Não é possivel calcular novamente!');
                    }
                    foreach($Carga->cidades() as $cidade){
                        $distancia = (new DistanceCity($cidade->getCoordenadas($Carga->filial->enderecos->first()->cidade->codigo),"$cidade->longitude,$cidade->latitude"))->showDistance();
                        array_push($maior, [$distancia,$cidade]);
                    }
                    sort($maior);
                    $CidadeFinal = end($maior)[1];
                    $destino = $CidadeFinal->nome . ', '.$CidadeFinal->estado->uf;
                    $Carga->destino = $destino;
                    // $modelUmFrete = ModeloUmFrete::where('cidades','like',"%alemana%")->get();
                    $modelUmFrete = ModeloUmFrete::where('cidades','like',"%".$CidadeFinal->nome."%")->get();
                    $pesoCarga = $Carga->peso();

                    if($modelUmFrete->count()==0){
                        throw new Exception('Cidade não encontrada');
                    }
                    $modeloUmFrete = $modelUmFrete->first();
                    // $cidade->getCoordenadas($carga->filial->enderecos->first()->cidade->codigo);
                    $pesoCalculo = 0;
                    if($pesoCarga > 0 && $pesoCarga <15000){
                        $pesoCalculo = 14;
                    }

                    $qtdEntregas = count($Carga->paradas());
                    $preco = 0;
                if($qtdEntregas==1){
                    $preco = $modeloUmFrete->um;
                }elseif($qtdEntregas==2 || $qtdEntregas==3){
                    $preco = $modeloUmFrete->dois;
                }elseif($qtdEntregas==4 || $qtdEntregas==5){
                    $preco = $modeloUmFrete->tres;
                }elseif($qtdEntregas==6 || $qtdEntregas==7){
                    $preco = $modeloUmFrete->quatro;
                }elseif($qtdEntregas>=8 && $qtdEntregas<=10){
                    $preco = $modeloUmFrete->cinco;
                }elseif($qtdEntregas>=11 && $qtdEntregas<=13){
                    $preco = $modeloUmFrete->seis;
                }elseif($qtdEntregas>=14 && $qtdEntregas<=16){
                    $preco = $modeloUmFrete->sete;
                }elseif($qtdEntregas>=17 && $qtdEntregas<=19){
                    $preco = $modeloUmFrete->oito;
                }elseif($qtdEntregas>=20 && $qtdEntregas<=23){
                    $preco = $modeloUmFrete->nome;
                }else{
                    $preco = $modeloUmFrete->dez;
                }

                $valorFrete = ($pesoCalculo*$preco);
                $Carga->frete = $valorFrete;

                $Carga->save();
                DB::commit();
                return response()->json(['status' => 200, 'msg' => ['cidade'=>$destino,'frete'=>number_format($valorFrete,2,',','.')]]);
                // return response()->json(['status' => 200, 'msg' => end($maior)[1]]);
            }catch(Exception $ex){
                DB::rollback();
                return response()->json(['status' => 0, 'msg' => $ex->getMessage()]);
            }
        }

        public function gerarListaDevolucao(Carga $carga){
            try{

                $dados = [];
                $totalItens = 0;
                $devolvidas = $carga->notasPorStatus('Devolvida');

                // echo '<pre>';
                // echo 'Notas Devolvidas: '.$devolvidas->count();
                // echo '<br />';

                foreach($devolvidas as $nota){
                    $dados['dados']['totalItens'] = $totalItens += $nota->volume;
                    $dados['dados']['remessa'] = $carga->remessa;
                    $dados['dados']['os'] = $carga->os;
                    $dados['dados']['carga']= $carga->id;
                    // $dados['dados']['precarga'] = $carga->precarga;
                    $dados['notas'][$nota->nota]['nota'] = (object)$nota;
                    // $dados['notas'][$nota->nota]['destinatario'] = (object)DestinatarioNota::find($nota->destinatario)->getAttributes();
                    // print_r($nota->produtos()->count());
                    // echo 'Nota: '.$nota->nota;
                    // echo '<br />';
                    foreach($nota->produtos as $produto){
                        // print_r($produto->getAttributes());
                        $dados['notas'][$nota->nota]['produtos'][] = (object)ProdutoNota::find($produto->id)->getAttributes();
                    }
                    // echo '<hr />';
                }
                // echo '</pre>';
                PdfsSistema::listaDevolucao($dados);
            }
            catch(Exception $ex){
                return $ex->getMessage();
            }
        }
}
