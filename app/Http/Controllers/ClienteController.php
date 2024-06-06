<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Filial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index',['clientes'=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

        echo '<pre>';
        print_r($request->input());
        echo '</pre>';

        $cliente = new Cliente();
        $cliente->newId();
        $cliente->name = $request->RazaoSocial;
        $cliente->usuario_id=Auth::check();
        $cliente->save();
        $filial = new Filial();
        $filial->newId();
        $filial->razao_social = $request->NomeFantasia;
        $filial->nome_fantasia = $request->NomeFantasia;
        $filial->responsavel = $request->Responsavel;
        $filial->cnpj = $request->Cnpj;
        $filial->ie = $request->IE;
        $filial->usuario_id=Auth::check();
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
        $cont->celular = $request->Telefone;
        $cont->whatsapp = $request->WhatsApp;
        $cont->email = $request->Email;
        $cont->descricao = $request->Descricao;
        $cont->usuario_id=Auth::check();
        $cont->save();

        $filial->contatos()->attach($cont->id);
        $filial->enderecos()->attach($end->id);

        echo '<pre>';
        print_r($cliente->getAttributes());
        print_r($filial->getAttributes());
        print_r($end->getAttributes());
        print_r($cont ->getAttributes());
        echo '</pre>';
        DB::commit();
    }catch(Exception $ex){
        DB::rollback();
        print_r($ex->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
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
