<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Municipio;
use App\Models\TipoDoc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!is_null(Auth::user()->tenant_id)){
            $fornecedor = Auth::user()->tenant->first()->fornecedor;
        }else{
            $fornecedor = Fornecedor::all();
        }
        return view('fornecedor.index', ['fornecedores' => $fornecedor]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cidades = Municipio::orderBy('nome', 'asc');
        $cidadesGet = $cidades->with('estado')->get();
        return view('fornecedor.create',['cidades'=>$cidadesGet]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            echo '<pre>';
            print_r($request->input());
            echo '</pre>';

            $fornec = Fornecedor::where('doc', (string)$request->Doc)->get();
            echo $fornec->count();
            echo '<br />' . $request->Doc;
            echo '<br />';
            if ($fornec->count() != 0) {
                // echo Auth::user()->tenant_id;
                $forn_tenant = DB::table('fornecedor_tenant')->select('*')->where('tenant_id',Auth::user()->tenant_id)->where('fornecedor_id',$fornec->first()->id)->get();
                if ($forn_tenant->count()!=0) {
                    throw new Exception('Fornecedor ja cadastrado para essa Empresa!');
                } else {
                    if(!is_null(Auth::user()->tenant_id)){
                        $fornec->first()->tentants()->attach(Auth::user()->tenant_id);
                    }
                    $msg = 'Fornecedor Atribuido a empresa com sucesso';
                }
            } else {

                $fornecedor = new Fornecedor();
                $fornecedor->newId();
                $fornecedor->name = $request->Name;
                $fornecedor->doc = $request->Doc;
                if (strlen($fornecedor->doc) == 11) {
                    $doc = TipoDoc::getTipoDocId('CPF');
                } elseif (strlen($fornecedor->doc) == 14) {
                    $doc = TipoDoc::getTipoDocId('CPF');;
                } else {
                    throw new Exception('Verifique o número do documento digitado');
                }
                $fornecedor->TipoDoc = $doc;
                $fornecedor->Descricao = $request->DescricaoFornecedor;
                $fornecedor->especialidade_id = $request->Especialidade;
                $endereco = new Endereco();
                $endereco->newId();
                $endereco->endereco = $request->rua;
                $endereco->numero = $request->numero;
                $endereco->bairro = $request->bairro;
                $endereco->cep = $request->cep;
                $endereco->cidade_id = $request->cidade_id;
                $endereco->estado_id = $request->estado_id;
                $endereco->save();

                $fornecedor->endereco_id = $endereco->id;
                $fornecedor->save();
                $fornecedor->tentants()->attach(Auth::user()->tenant_id);
                $contato = new Contato();
                $contato->newId();
                $contato->telefone = $request->Telefone;
                $contato->whatsapp = $request->WhatsApp;
                $contato->email = $request->Email;
                $contato->descricao = $request->Descricao;
                $contato->usuario_id = Auth::user()->id;
                // $contato->usuario_id = Auth::user()->id;
                $contato->save();

                $fornecedor->contatos()->attach($contato->id);

                echo '<pre>';
                print_r($fornecedor->getAttributes());
                echo '</pre>';
                // return ;
                $msg = 'Fornecedor Cadastrado com sucesso';
            }
            DB::commit();
            return $msg;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornecedor $fornecedor)
    {
        return view('fornecedor.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedor.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }
}
