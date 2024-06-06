<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Contato;
use App\Models\Empresa;
use App\Models\Endereco;
use Exception;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::All();
        return view('empresa.index',['empresas'=>$empresas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rota = 'empresa.store';
        return view('empresa.create',['rota'=>$rota]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            DB::beginTransaction();
            // print_r($request->input());



            // $endereco = Endereco::create($request->all());



            $endereco = new Endereco();
            $endereco->endereco = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->cidade_id = $request->cidade_id;
            $endereco->estado_id = $request->estado_id;
            $endereco->save();

            $empresa = new Empresa();
            $empresa->nome = $request->input('RazaoSocial');
            $empresa->nome_fantasia = $request->input('NomeFantasia');
            $empresa->usuario_id = Auth::check();
            $empresa->save();

            $empresa->enderecos()->attach($endereco->id);

            $contato = new Contato();
            $contato->celular =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->usuario_id = Auth::check();
            $contato->save();
            $empresa->contatos()->attach($contato->id);

            // echo '<pre>';
            // print_r($empresa);
            // print_r($endereco);
            // echo '</pre>';

            // exit;
            DB::commit();

            return redirect()->route('empresa.show',['empresa'=>$empresa->id])->with('message', ['status' => 'success', 'msg' => 'Empresa Cadastrada com sucesso!']);
        }catch(Exception $ex){
            DB::rollBack();

            echo '<pre>';
            print_r($ex->getMessage());
            echo '</pre>';


        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        // print_r($empresa->getAttributes());

        // echo '<pre>';
        // print_r($empresa->certificate);
        // echo '</pre>';

        // $Certificados = Certificado::with('empresa')->get();
        // return view('empresa.show',['certificados'=>$Certificados]);
        return view('empresa.show',['empresa'=>$empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $rota = 'empresa.update';
        $end = $empresa->enderecos()->get()->first();
        $cont = $empresa->contatos()->get()->first();
        return view('empresa.edit', ['empresa'=>$empresa,'disabled'=>'no', 'rota'=>$rota,'endereco'=>$end,'contato'=>$cont]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        echo '<pre>';
        print_r($request->input());
        echo '</pre>';
        // print_r($empresa->getAttributes());
        $empresa->nome = $request->RazaoSocial;
        $empresa->nome_fantasia = $request->NomeFantasia;
        $empresa->nome = $request->CpfCnpj;

        if($empresa->enderecos()->count()==0){
            $end = new Endereco();
            $end->id = $end->newId();
            $end->endereco = $request->rua;
            $end->numero = $request->numero;
            $end->bairro = $request->bairro;
            $end->cep = $request->cep;
            $end->cidade_id = 1;
            $end->estado_id = 1;
            $end->save();
            $empresa->enderecos()->attach($end->id);
            // print_r($end->getAttributes());
        }else{
            $end = $empresa->enderecos()->first();
            $end->endereco = $request->rua;
            $end->numero = $request->numero;
            $end->bairro = $request->bairro;
            $end->cep = $request->cep;
            $end->cidade_id = 1;
            $end->estado_id = 1;
            $end->save();
        }


        if($empresa->contatos()->count()==0){
            $contato = new Contato();
            $contato->celular =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->usuario_id = Auth::check();
            $contato->save();
            $empresa->contatos()->attach($contato->id);
        }else{
            $contato = $empresa->contatos()->first();
            $contato->celular =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->save();
        }
        // else{
        //     // print_r($empresa->enderecos()->first()->getAttributes());
        // }
        // echo '</pre>';
        //     echo 'ola';

        //     print_r($contato->getAttributes());
        // return;
        $empresa->save();

        return redirect()->route('empresa.edit',['empresa'=>$empresa->id])->with('message', ['status' => 'success', 'msg' => 'Empresa Atualizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }

    public function certificate(){
        $empresas = Empresa::All();
        return view('empresa.certificado',['empresas'=>$empresas]);
    }
    public function certificateStore(Request $request){

        //salvar no banco de dados as informacoes do certificado

        print_r($request->input());

        // echo $path = $request->file('Certificado')->store('certificados');
        // echo $path = Storage::putFile('Certificados', $request->file('Certificado'));
        if($request->file('Certificado')->getClientOriginalExtension()!= 'pfx')
        {
            echo 'erro de arquivo';
            return ;
        }

        $certificado =  new Certificado();

        $certificado->name = Empresa::find($request->empresa_id)->name;
        $certificado->password = Hash::make($request->SenhaCertificado);
        $certificado->validate = $request->ValidadeCertificado;
        $certificado->empresa_id = $request->empresa_id;
        $certificado->usuario_id = Auth::check();
        $path = $request->file('Certificado')->storeAs('certificados',$certificado->name.'.pfx');
        $certificado->path = $path;
        $certificado->save();
        // return redirect()->back()->with('message', ['status' => 'success', 'msg' => 'Certificado carregado com sucesso']);
    }

}
