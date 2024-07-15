<?php

namespace App\Http\Controllers;

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
            // examples with aliases, pipe-separated names, guards, etc:
            // 'role_or_permission:manager|edit articles',
            new Middleware('permission:Deletar Veiculo', only: ['destroy']),
            new Middleware('permission:Listar Veiculos', only: ['index']),
            new Middleware('permission:Show Empresa', only: ['show']),
            new Middleware('permission:Editar Empresa', only: ['edit', 'update']),
            new Middleware('permission:Nova Empresa', only: ['create', 'store']),
            new Middleware('permission:Carrega Notas', only: ['notas', 'notasStore']),
            new Middleware('permission:Visualizar Certificado', only: ['certificate','certificateStore']),
            new Middleware('permission:Deletar Nota', only: ['deletaNotaCarregada','deletaTodasNotaCarregada']),
            // new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except:['show']),
            // new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete role'), only:['destroy']),
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
            $veiculo->empresa_id = LocalApoio::find((int)$request->empresa_local_apoio_id)->empresa_id;
            $veiculo->local_apoio_id = $request->empresa_local_apoio_id;
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
            return response()->json(['status' => 0, 'msg' =>$ex->getMessage()]);
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
}
