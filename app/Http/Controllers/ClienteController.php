<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Filial;
use App\Models\Frete;
use App\Models\LocalMovimentacao;
use App\Models\Municipio;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Deletar Cliente', only: ['destroy']),
            new Middleware('permission:Listar Cliente', only: ['index']),
            new Middleware('permission:Show Cliente', only: ['show']),
            new Middleware('permission:Editar Cliente', only: ['edit', 'update']),
            new Middleware('permission:Criar Cliente', only: ['create', 'store']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        $fretes = Frete::all();
        return view('cliente.index',['clientes'=>$clientes,'fretes'=>$fretes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $cidades = DB::table('municipios');
        // $ufs = ['PE','PB','AL','RN'];
        // $ufs = ['26','25','27','43'];
        // $cidades->whereIn('estado_id', $ufs);
        $cidades = Municipio::orderBy('nome', 'asc');
        $cidadesGet = $cidades->with('estado')->get();
        return view('cliente.create',['cidades'=>$cidadesGet]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

        // echo '<pre>';
        // print_r($request->input());
        // echo '</pre>';

        $cliente = new Cliente();
        $cliente->newId();
        $cliente->name = $request->RazaoSocial;
        $cliente->usuario_id=Auth::user()->id;
        $cliente->save();

        $filial = new Filial();
        $filial->newId();
        $filial->razao_social = $request->NomeFantasia;
        $filial->nome_fantasia = $request->NomeFantasia;
        $filial->link = str_replace(' ','',strtolower($request->NomeFantasia));
        $filial->responsavel = $request->Responsavel;
        $filial->cnpj = $request->Cnpj;
        $filial->ie = $request->IE;
        $filial->usuario_id=Auth::user()->id;
        $filial->save();
        $filial->clientes()->attach($cliente->id);

        $end = new Endereco();
        $end->newId();
        $end->endereco = $request->rua;
        $end->numero = $request->numero;
        $end->bairro = $request->bairro;
        $end->cep = $request->cep;
        $end->cidade_id = $request->cidade_id;
        $end->estado_id = $request->estado_id;
        $end->save();

        $cont = new Contato();
        $cont->newId();
        $cont->telefone = $request->Telefone;
        $cont->whatsapp = $request->WhatsApp;
        $cont->email = $request->Email;
        $cont->descricao = $request->Descricao;
        $cont->usuario_id=Auth::user()->id;
        $cont->save();

        $filial->contatos()->attach($cont->id);
        $filial->enderecos()->attach($end->id);

        $localMov = new LocalMovimentacao();
        $localMov->newId();
        $localMov->title = $filial->nome_fantasia;
        $localMov->descricao = 'local de carregamento e descarremento de carga do cliente '.$cliente->name;
        $localMov->status_id = $localMov->getStatusId('Ativo');
        $localMov->usuario_id = Auth::user()->id;
        $localMov->save();
        $localMov->tentants()->attach( $localMov->id);
        $filial->locaismovimetacoes()->attach($localMov->id);

        // echo '<pre>';
        // print_r($cliente->getAttributes());
        // print_r($filial->getAttributes());
        // print_r($end->getAttributes());
        // print_r($cont ->getAttributes());
        // echo '</pre>';

        // dd($cliente);
        DB::commit();
        return response()->json(['status'=>200,'msg'=>'Clliente cadastrado com sucesso!']);
    }catch(Exception $ex){
        DB::rollback();
        return response()->json(['status'=>0,'msg'=>$ex->getMessage()]);
        // print_r($ex->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        dd($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
