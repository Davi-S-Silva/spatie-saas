<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Empresa;
use App\Models\Filial;
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
        return view('veiculo.index', ['veiculos'=>Veiculo::all()]);
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
            $veiculo->placa = $request->Placa;
            // $veiculo->empresa_id = LocalApoio::find((int)$request->empresa_local_apoio_id)->empresa_id;
            $veiculo->empresa_id = (!is_null($request->empresa_local_apoio_id))?LocalApoio::find($request->empresa_local_apoio_id)->empresa->id:1;
            $veiculo->local_apoio_id = (!is_null($request->empresa_local_apoio_id))?$request->empresa_local_apoio_id:null;
            $veiculo->tenant_id = (is_null($veiculo->tenant_id))? Empresa::find($veiculo->empresa_id)->tenant_id :$veiculo->tenant_id;
            $veiculo->usuario_id =Auth::user()->id;
            $veiculo->setStatus('Disponivel');
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
        dd($veiculo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veiculo $veiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        //
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


}
