<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Filial;
use App\Models\LocalMovimentacao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cliente)
    {
        return view('filial.create', ['cliente'=>$cliente]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            // echo '<pre>';print_r($request->input());echo '</pre>';

            if(Filial::where('cnpj',$request->Cnpj)->where('tenant_id',Auth::user()->tenant_id)->get()->count()!=0){
                throw new Exception('Cliente já cadastrado para esse Tenant');
            }
            $filial = new Filial();
            $filial->newId();
            $filial->razao_social = $request->RazaoSocial;
            $filial->nome_fantasia = $request->NomeFantasia;
            $filial->link = str_replace(' ','',strtolower($request->NomeFantasia));
            $filial->responsavel = $request->Responsavel;
            $filial->cnpj = $request->Cnpj;
            $filial->ie = $request->IE;
            $filial->usuario_id=Auth::user()->id;
            $filial->save();
            $filial->clientes()->attach($request->Cliente);

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
            $localMov->title = $filial->nome_fantasia;
            $localMov->descricao = 'local de carregamento e descarremento de carga do cliente '. Cliente::find($request->Cliente)->name;
            $localMov->status_id = 1;
            $localMov->usuario_id = Auth::user()->id;
            $localMov->save();
            $filial->locaismovimetacoes()->attach($localMov->id);
            DB::commit();
        }catch(Exception $ex){
            DB::rollback();
            print_r($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Filial $filial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filial $filial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filial $filial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filial $filial)
    {
        //
    }
}
