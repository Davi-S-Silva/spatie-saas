<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Contato;
use App\Models\DocColaborador;
use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\LocalApoio;
use App\Models\LocalMovimentacao;
use App\Models\Tenant;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
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
    public function create()
    {
        $rota = 'tenant.store';
        return view('tenant.create',['rota'=>$rota]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $tenant = new Tenant();
            $tenant->newId();
            $tenant->name = $request->input('RazaoSocial');
            $tenant->tipo_doc = $request->PessoaFisicaJuridica;
            $tenant->doc = $request->CpfCnpj;
            $tenant->save();
            // $tenant->user()->attach(Auth::user()->id);

            $endereco = new Endereco();
            $endereco->newId();
            $endereco->endereco = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->cidade_id = $request->cidade_id;
            $endereco->estado_id = $request->estado_id;
            $endereco->save();

            $empresa = new Empresa();
            $empresa->newId();
            $empresa->nome = $request->input('RazaoSocial');
            $empresa->nome_fantasia = $request->input('NomeFantasia');
            $empresa->tipo_doc = $request->PessoaFisicaJuridica;
            $empresa->doc = $request->CpfCnpj;
            $empresa->tenant_id = $tenant->id;
            $empresa->usuario_id = Auth::user()->id;
            $empresa->save();

            $empresa->enderecos()->attach($endereco->id);

            $localApoio = new LocalApoio();
            $localApoio->newId();
            $localApoio->name = $request->input('RazaoSocial');
            $localApoio->description = 'Sede da empresa '.$request->input('RazaoSocial');
            $localApoio->empresa_id = $empresa->id;
            $localApoio->tenant_id = $tenant->id;
            $localApoio->usuario_id = Auth::user()->id;
            $localApoio->save();
            // $empresa->localapoios()->attach($localApoio->id);

            $localMov = new LocalMovimentacao();
            $localMov->newId();
            $localMov->title = $localApoio->name;
            $localMov->descricao = $localApoio->name . ' local de apoio da ' . $request->input('RazaoSocial');
            $localMov->status_id = $localMov->getStatusId('Ativo');
            $localMov->usuario_id = Auth::user()->id;
            $localMov->save();
            $localMov->tentants()->attach($tenant->id);

            $localApoio->locaismovimetacoes()->attach($localMov->id);

            $contato = new Contato();
            $contato->newId();
            $contato->telefone =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->usuario_id = Auth::user()->id;
            $contato->save();
            $empresa->contatos()->attach($contato->id);

            $user = new User();
            $user->newId();
            $user->name = $request->input('RazaoSocial');
            $user->email = $request->Email;
            $user->tenant_id = $tenant->id;
            $user->password = Hash::make('password');

            $user->save();
            $user->empresa()->attach($empresa->id);
            $user->tenant()->attach($tenant->id);
            $user->syncRoles(['tenant-admin-master']);

            $colaborador = new Colaborador();
            $colaborador->newId();
            $colaborador->name = $user->name;
            $colaborador->apelido = $user->name;
            $colaborador->foto_path = '';
            $colaborador->data_nascimento = '0001-01-01';
            $colaborador->tipo_id = 1;
            $colaborador->funcao_id = 7;
            $colaborador->tenant_id = $tenant->id;
            $colaborador->empresa_id = $empresa->id;
            $colaborador->local_apoio_id = $localApoio->id;
            $colaborador->usuario_id = $user->id;
            $colaborador->setStatus('Disponivel');
            $colaborador->save();
            $user->colaborador()->attach($colaborador->id);

            $DocColaborador = new DocColaborador();
            $DocColaborador->newId();
            $DocColaborador->tipo_id = $DocColaborador->getTipoDocId('CPF');
            $DocColaborador->colaborador_id = $colaborador->id;
            $DocColaborador->numero = $tenant->doc;
            $DocColaborador->save();

            DB::commit();

            return redirect()->route('tenant.index')->with('message', ['status' => 'success', 'msg' => 'Tenant Cadastrado com sucesso!']);
            // return redirect()->route('empresa.show',['empresa'=>$empresa->id])->with('message', ['status' => 'success', 'msg' => 'Empresa Cadastrada com sucesso!']);
        }catch(Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('message', ['status' => 'danger', 'msg' => 'Empresa não Cadastrada! erro: '.$ex->getMessage().' - '.$ex->getFile(). ' - '.$ex->getLine()]);
            // echo '<pre>';
            // print_r($ex->getMessage());
            // echo '</pre>';


        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
