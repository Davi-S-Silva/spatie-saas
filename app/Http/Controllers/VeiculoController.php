<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Empresa;
use App\Models\Filial;
use App\Models\Km;
use App\Models\LocalApoio;
use App\Models\Proprietario;
use App\Models\Veiculo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:Deletar Veiculo', only: ['destroy']),
            new Middleware('permission:Listar Veiculo', only: ['index']),
            new Middleware('permission:Show Veiculo', only: ['show']),
            new Middleware('permission:Editar Veiculo', only: ['edit', 'update']),
            new Middleware('permission:Criar Veiculo', only: ['create', 'store']),
            new Middleware('permission:Associar Colaborador', only: ['associaColaborador']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('veiculo.index', ['veiculos'=>Veiculo::where('tipo_veiculo_id','<>',40)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('veiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->input());
        // echo '</pre>';
        try{
            DB::beginTransaction();
            // return response()->json(['status' => 200, 'msg' =>$request->input()]);
            $veiculo = new Veiculo();
            $veiculo->newId();
            $veiculo->placa = $request->Placa;
            $veiculo->final_placa = (int)substr($request->Placa,-1);
            // $veiculo->empresa_id = LocalApoio::find((int)$request->empresa_local_apoio_id)->empresa_id;
            $veiculo->empresa_id = (!is_null($request->empresa_local_apoio_id))?LocalApoio::find($request->empresa_local_apoio_id)->empresa->id:1;
            $veiculo->local_apoio_id = (!is_null($request->empresa_local_apoio_id))?$request->empresa_local_apoio_id:null;
            // $empresa = Empresa::find($veiculo->empresa_id);
            $veiculo->tenant_id =  Empresa::find($veiculo->empresa_id)->tenant_id;//(!is_null($empresa->tenant_id))? $empresa->tenant_id :null;
            $veiculo->usuario_id = Auth::user()->id;
            $veiculo->setStatus('Disponivel');
            $veiculo->ano_modelo = $request->AnoModelo;
            $veiculo->ano_fabricacao = $request->AnoFabricacao;
            $veiculo->ano_exercicio = $request->AnoExercicio;
            $veiculo->chassi = $request->Chassi;
            $veiculo->renavam = $request->Renavam;
            $veiculo->potencia = $request->Potencia;
            $veiculo->capacidade = $request->Capacidade;
            $veiculo->peso_bruto = $request->PesoBruto;
            $veiculo->eixo = $request->Eixo;
            $veiculo->lotacao = $request->Lotacao;
            $veiculo->carroceria = $request->Carroceria;
            $veiculo->tipo_veiculo_id = (int)$request->TipoVeiculo;
            $veiculo->cor = $request->Cor;
            $veiculo->marca_modelo = $request->MarcaModelo;
            $veiculo->combustivel_id = (int)$request->Combustivel;
            $veiculo->categoria_veiculo_id =(int) $request->Categoria;
            $veiculo->data_aquisicao = $request->DataAquisicao;
            // return response()->json(['status' => 200, 'msg' =>[$veiculo->getAttributes(),$request->input()]]);
            if(isset($request->proprietario) && !is_null($request->proprietario)){
                $veiculo->proprietario_id = $request->proprietario;
            }else{
                $prop = new Proprietario();
                $prop->newId();
                if(empty($request->NameProp) || empty($request->DocProp)){
                    throw new Exception('Preencha nome e documento do proprietario');
                }
                $prop->nome_razao_social = addslashes($request->NameProp);
                $prop->cpf_cnpj = addslashes($request->DocProp);
                $prop->save();
                $veiculo->proprietario_id = $prop->id;
            }

            $veiculo->save();

            $km = new Km();
            $km->newId();
            $km->setKm($veiculo,$request->Km);
            $km->save();

            // $km->veiculo()->attach($veiculo->id);
            // echo '<pre>';
            // print_r($veiculo->getAttributes());
            // echo '</pre>';
            DB::commit();
            return response()->json(['status' => 200, 'msg' =>'Veiculo cadastrado com sucesso!']);
        }catch(Exception $ex){
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' =>$ex->getMessage(). ' - '.$ex->getLine()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        // dd($veiculo->getAttributes());
        // dd($veiculo->kms()->get()->first()->veiculo->placa);
        return view('veiculo.show',['veiculo'=>$veiculo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veiculo $veiculo)
    {
        //
        return view('veiculo.edit',['veiculo'=>$veiculo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        dd($request->input());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veiculo $veiculo)
    {
        //
    }

    public function mudarVeiculoDeCliente($veiculo_id, $cliente_id)
    {
        $veiculo = DB::table('cliente_veiculo')->where('veiculo_id',$veiculo_id)->update(['cliente_id'=>$cliente_id]);

        print_r($veiculo);

        return;
    }

    public function associaColaborador(Request $request, $veiculo)
    {
        try{
            $Veiculo = Veiculo::find($veiculo);
            $response = $Veiculo->associaColaborador($request->colaborador);
            return response()->json(['status'=>200,'msg'=>['veiculo'=>(int)$veiculo,'colaborador'=>Colaborador::find($request->colaborador)->name,
            'veiculoLimpo'=>$response,'success'=>'Colaborador associado com sucesso!']]);
        }catch(Exception $ex){
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }

    public function getSemiReboques()
    {
        try{
            $veiculos = Veiculo::getSemiReboques(6);
            $semi = [];
            if($veiculos->count()==0){
                throw new Exception('não há semi reboque cadastrado');
            }
            foreach($veiculos as $veiculo){
                $semi[]= ['id'=>$veiculo->id,'placa'=>$veiculo->placa];
            }
            return response()->json(['status'=>200,'veiculos'=>$semi]);
        }catch(Exception $ex){
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }
    public function atrelarSemiReboque($veiculo,$semireboque)
    {
        try{
            $Veiculo = Veiculo::find($veiculo);
            $response = $Veiculo->associaReboque($semireboque);
            return response()->json(['status'=>200,'msg'=>['veiculo'=>(int)$veiculo,'semireboque'=>Veiculo::find($semireboque)->placa,
            'veiculoLimpo'=>$response,'success'=>'Semireboque associado com sucesso!']]);
        }catch(Exception $ex){
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }

        // return response()->json(['status'=>20,'msg'=>$semireboque . ' - '.$Veiculo->placa]);
    }

}
