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
use ZipArchive;

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
            $empresa->tipo_doc = $request->PessoaFisicaJuridica;
            $empresa->doc = $request->CpfCnpj;
            $empresa->usuario_id = Auth::user()->id;
            $empresa->save();

            $empresa->enderecos()->attach($endereco->id);

            $contato = new Contato();
            $contato->celular =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->usuario_id = Auth::user()->id;
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
        $empresa->tipo_doc = $request->PessoaFisicaJuridica;
        $empresa->doc = $request->CpfCnpj;

        if($empresa->enderecos()->count()==0){
            $end = new Endereco();
            $end->newId();
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
            $contato->newId();
            $contato->telefone =$request->Telefone;
            $contato->whatsapp = $request->WhatsApp;
            $contato->email = $request->Email;
            $contato->descricao = $request->Descricao;
            $contato->usuario_id = Auth::user()->id;
            $contato->save();
            $empresa->contatos()->attach($contato->id);
        }else{
            $contato = $empresa->contatos()->first();
            $contato->telefone =$request->Telefone;
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
        $certificado->newId();
        $certificado->name = Empresa::find($request->empresa_id)->name;
        $certificado->password = Hash::make($request->SenhaCertificado);
        $certificado->validate = $request->ValidadeCertificado;
        $certificado->empresa_id = $request->empresa_id;
        $certificado->usuario_id = Auth::user()->id;
        $path = $request->file('Certificado')->storeAs('certificados',$certificado->name.'.pfx');
        $certificado->path = $path;
        $certificado->save();
        // return redirect()->back()->with('message', ['status' => 'success', 'msg' => 'Certificado carregado com sucesso']);
    }

    public function notas()
    {
        $path = getenv('RAIZ').'/storage/app/public/notas/';
        $nfes = [];
        if(file_exists($path)){
            $notas = dir($path);

            while (($arquivo = $notas->read()) !== false) {
                // $file = $pasta . '/' . $arquivo;
                if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'Autorizada' && $arquivo != 'Nao autorizada') {
                    $nfes[]= str_replace('.xml','',$arquivo);
                }
            }
        }
        return view('empresa.notas',['notas'=>$nfes]);
    }
    public function notasStore(Request $request)
    {
        $notas = [];
        // $empresa = preg_replace('/[^A-Za-z0-9]/', '',str_replace(' ','',strtolower(Empresa::find($request->empresa_id)->nome)));
        if(empty($request->notas)){
            throw new Exception('Selecione o arquivo que deseja importar');
        }
        foreach($request->notas as $nota){
            if($nota->getClientOriginalExtension()=='zip' || $nota->getClientOriginalExtension()=='ZIP'){
                // $notas[]=['nome'=>$nota->getClientOriginalExtension()];
                Storage::disk('local')->putFileAs('public/notas',$nota, $nota->getClientOriginalName());
                // $caminhoZip = getEnv('RAIZ').Storage::disk('local')->url($nota->getClientOriginalName());
                $caminhoZip = getenv('RAIZ').'/storage/app/public/notas/'.$nota->getClientOriginalName();
                $extractZip = getenv('RAIZ').'/storage/app/public/notas/';
                // storage\app\public\notas\Autorizada\Transportadas\NFes-49152106000108 (85).zip
                if(file_exists($caminhoZip)){
                    $zip = new ZipArchive;
                    if($zip->open($caminhoZip)){
                        // echo '<br />existe';
                        // echo 'zip: '.$extractZip.'<br />';
                        $zip->extractTo($extractZip);
                        $zip->close();
                        if(file_exists($extractZip.'Autorizada/Transportadas')){
                            // echo 'ola';
                            $d = dir($extractZip.'Autorizada/Transportadas/');
                            while($filemove = $d->read()){
                                if($filemove != '..' && $filemove != 'Autorizada' && $filemove != 'Transportadas'){
                                    if(is_file($extractZip.'Autorizada/Transportadas/'.$filemove)){
                                         copy($extractZip.'Autorizada/Transportadas/'.$filemove, $extractZip.$filemove);
                                        // unset($extractZip.'Autorizada/Transportadas/'.$filemove);
                                        unlink($extractZip.'Autorizada/Transportadas/'.$filemove);
                                        // echo $extractZip.'Autorizada/Transportadas/'.$filemove.'<br />';
                                    }
                                }
                            }
                            // return;
                        }
                        unlink($caminhoZip);
                        // $msg = 'Arquivo descompactado com sucesso.';
                    }else{
                        throw new Exception('Erro ao abrir arquivo');
                    }
                }else{
                    throw new Exception("Arquivo zip nao existe", 1);
                }

            }
            elseif($nota->getClientOriginalExtension()=='xml')
            {
                // $notas[]=['nome'=>$nota->getClientOriginalExtension()];
                Storage::disk('local')->putFileAs('public/notas',$nota, $nota->getClientOriginalName());

            }else{
                throw new Exception('formato de arquivo nao permitido');
            }
        }

        // exit;
        $pasta = getEnv('RAIZ') . Storage::disk('local')->url('app/public/notas');
        $diretorio = dir($pasta);
        // sleep(5);
        while (($arquivo = $diretorio->read()) !== false) {
            $file = $pasta . '/' . $arquivo;
            if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'Autorizada' && $arquivo != 'Nao autorizada'&& $arquivo != 'Cancelada' && $arquivo != 'Eventos') {
                // $data = file_get_contents($file);
                $xml = simplexml_load_file($file);

                if($xml->NFe){
                    copy($file,$pasta.'/'.$xml->protNFe->infProt->chNFe.'.xml');
                    if(str_contains($file,'NFe')){
                        unlink($file);
                    }
                    $notas[]= $xml->NFe->infNFe->ide->nNF;
                }
            }
        }




        // return response()->json($xml->protNFe->infProt->chNFe);
        return response()->json(['status' => 'success', 'msg' =>'Notas carregadas com sucesso!']);
    }

    public function deletaNotaCarregada($nota){
        $pasta = getEnv('RAIZ') . Storage::disk('local')->url('app/public/notas');
        if(file_exists($pasta.'/'.$nota.'.xml')){
            unlink($pasta.'/'.$nota.'.xml');
        }
        if(file_exists($pasta.'/'.$nota.'.zip')){
            unlink($pasta.'/'.$nota.'.zip');
        }
        if(file_exists($pasta.'/'.$nota.'.ZIP')){
            unlink($pasta.'/'.$nota.'.ZIP');
        }
        return response()->json(['status' => 'success', 'msg' =>'Nota '.$nota.' excluida com sucesso!','nota'=>$nota]);
        // return response()->json($nota);
    }

    public function deletaTodasNotaCarregada(Request $request){

        return response()->json($request->input());

    }
}
