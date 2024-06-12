<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\FuncaoColaborador;
use App\Models\LocalApoio;
use App\Models\TipoColaborador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColaboradorController extends Controller
{
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
            $colaborador = new Colaborador();

            $colaborador->newId();
            $colaborador->name = $request->name;
            $colaborador->apelido = $request->apelido;
            $colaborador->foto_path = $request->file('foto_path');
            $colaborador->data_nascimento = $request->data_nascimento;
            $colaborador->tipo_id = $request->tipo_id;
            $colaborador->funcao_id = $request->funcao_id;



            $colaborador->empresa_id = LocalApoio::find($request->empresa_local_apoio_id)->empresa->id;
            $colaborador->local_apoio_id = $request->empresa_local_apoio_id;
            $colaborador->usuario_id = Auth::check();
            $colaborador->save();

            $endereco = new Endereco();
            $endereco->endereco = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->cidade_id = $request->cidade_id;
            $endereco->estado_id = $request->estado_id;
            $endereco->save();
            $colaborador->enderecos()->attach($endereco->id);

            $contato = new Contato();
            $contato->telefone =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->usuario_id = Auth::check();
            $contato->save();
            $colaborador->contatos()->attach($contato->id);

            echo '<pre>';
            // print_r($colaborador->getAttributes());
            echo '</pre>';
            // exit;
            DB::commit();
        }catch(Exception $ex){
            DB::rollback();
            print_r($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Colaborador $colaborador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colaborador $colaborador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Colaborador $colaborador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colaborador $colaborador)
    {
        //
    }
}
