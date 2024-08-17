<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Contato;
use App\Models\DocColaborador;
use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\FuncaoColaborador;
use App\Models\LocalApoio;
use App\Models\TipoColaborador;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ColaboradorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Deletar Colaborador', only: ['destroy']),
            new Middleware('permission:Listar Colaborador', only: ['index']),
            new Middleware('permission:Show Colaborador', only: ['show']),
            new Middleware('permission:Editar Colaborador', only: ['edit', 'update']),
            new Middleware('permission:Criar Colaborador', only: ['create', 'store']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('colaborador.index',['Colaboradores'=>Colaborador::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $TipoColaborador = TipoColaborador::orderby('tipo','asc')->get();
        $FuncaoColaborador = FuncaoColaborador::orderby('funcao','asc')->get();
        return view('colaborador.create',['TipoColaborador'=>$TipoColaborador,'FuncaoColaborador'=>$FuncaoColaborador]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            // print_r($request->input());
            // echo $request->empresa_local_apoio_id;
            // echo '<pre>';
            // print_r(LocalApoio::find($request->empresa_local_apoio_id)->empresa->id);
            // echo '</pre>';
            // exit;

            // $col = Colaborador::all();

            // return $col->count();
            $colaborador = new Colaborador();
            $colaborador->newId();
            $colaborador->name = $request->name;
            $colaborador->apelido = $request->apelido;
            $colaborador->foto_path = $request->file('foto_path');
            $colaborador->data_nascimento = $request->data_nascimento;
            $colaborador->tipo_id = $request->tipo_id;
            $colaborador->funcao_id = $request->funcao_id;
            $colaborador->tenant_id = (!is_null($colaborador->tenant_id))?Empresa::find($colaborador->empresa_id)->tenant_id:$colaborador->tenant_id;
            $colaborador->empresa_id = (!is_null($request->empresa_local_apoio_id))?LocalApoio::find($request->empresa_local_apoio_id)->empresa->id:1;
            $colaborador->local_apoio_id = (!is_null($request->empresa_local_apoio_id))?$request->empresa_local_apoio_id:null;
            $colaborador->usuario_id = Auth::user()->id;
            $colaborador->setStatus('Disponivel');
            $colaborador->save();

            $DocColaborador = new DocColaborador();
            $DocColaborador->newId();
            $DocColaborador->tipo_id = $DocColaborador->getTipoDocId('CPF');
            $DocColaborador->colaborador_id = $colaborador->id;
            $DocColaborador->numero = $request->CPF;
            $DocColaborador->save();

            $endereco = new Endereco();
            $endereco->newId();
            $endereco->endereco = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->cidade_id = $request->cidade_id;
            $endereco->estado_id = $request->estado_id;
            $endereco->save();
            $colaborador->enderecos()->attach($endereco->id);

            $contato = new Contato();
            $contato->newId();
            $contato->telefone =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->usuario_id = Auth::user()->id;
            // $contato->usuario_id = Auth::user()->id;
            $contato->save();
            $colaborador->contatos()->attach($contato->id);

            $user = new User();
            $user->newId();
            $user->name = $request->name;
            $user->email = $request->Email;
            $user->password = Hash::make('password');
            $empresa = Empresa::find($colaborador->empresa_id);
            if($empresa->id != 1){
                $user->tenant_id = $empresa->tenant_id;
            }
            $user->save();
            $user->empresa()->attach($empresa->id);
            $user->colaborador()->attach($colaborador->id);
            // $colaborador->tenant()->attach($empresa->tenant_id);
            if($empresa->id == 1){
                $user->roles()->attach(6);//
            }else{
                $user->roles()->attach(7);//
            }

            // echo '<pre>';
            // print_r($colaborador->getAttributes());
            // print_r($user->getAttributes());
            // print_r($contato->getAttributes());
            // print_r($endereco->getAttributes());
            // echo '</pre>';
            // exit;
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Colaborador cadastrado com sucesso!']);
        }catch(Exception $ex){
            DB::rollback();
            // print_r($ex->getMessage().' - File: '.$ex->getFile().' - '.$ex->getLine());
            return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($colaborador)
    {
        $Colab = Colaborador::find($colaborador);
        if(count($Colab->usuario)!=0){
            echo '<pre>';
            print_r($Colab->usuario->first()->getAttributes());
            print_r($Colab->entregas);
            print_r($Colab->cargas);
            echo '</pre>';
        }else{
            echo 'não há usuario associado ao colaborador';
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colaborador $colaborador)
    {
        // $TipoColaborador = TipoColaborador::orderby('tipo','asc')->get();
        // $FuncaoColaborador = FuncaoColaborador::orderby('funcao','asc')->get();
        // return view('colaborador.edit',['TipoColaborador'=>$TipoColaborador,'FuncaoColaborador'=>$FuncaoColaborador]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $Colab)
    {
        $colaborador= Colaborador::find($Colab);
        echo '<pre>';
        print_r($colaborador->first()->getAttributes());
        print_r($request->input());
        echo '</pre>';
        $colaborador->name = $request->name;
        $colaborador->funcao_id = $request->funcao_id;

        $colaborador->save();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colaborador $colaborador)
    {
        //
    }
}
