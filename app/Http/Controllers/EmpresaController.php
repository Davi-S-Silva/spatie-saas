<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Empresa;
use App\Models\Endereco;
use Exception;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
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
        return view('empresa.create');
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
            $endereco->rua = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;
            $endereco->cidade_id = $request->cidade_id;
            $endereco->estado_id = $request->estado_id;
            $endereco->save();        

            $empresa = new Empresa();
            $empresa->name = $request->input('RazaoSocial');  
            $empresa->save();

            $empresa->enderecos()->attach($endereco->id);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
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
        $path = $request->file('Certificado')->storeAs('certificados',$certificado->name.'.pfx');
        $certificado->path = $path;
        $certificado->save();
        // return redirect()->back()->with('message', ['status' => 'success', 'msg' => 'Certificado carregado com sucesso']);
    }

}
