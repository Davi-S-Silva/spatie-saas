<?php

namespace App\Http\Controllers;

use App\Models\CEP;
use App\Models\Entrega;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LocalizacaoVeiculoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Listar Localizacao', only: ['index', 'monitorarVeiculo','rastrearTodosVeiculos']),
            new Middleware('permission:Nova ...', only: ['create', 'store']),
            new Middleware('permission:Show ...', only: ['show']),
            new Middleware('permission:Editar ...', only: ['edit', 'update']),
            new Middleware('permission:Deletar ...', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cr = curl_init();
        $headr = array();
        $headr[] = 'Content-length: 0';
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . $this->autenticaLocalizacaoApi();
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($cr, CURLOPT_URL, "http://api.exitvs.com.br/v1/Localizacao");
        curl_setopt($cr, CURLOPT_POST, TRUE);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        $obj = json_decode($retorno);
        return view('veiculo.localizacao.index',['locations'=>$obj]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('veiculo.monitoramento.show');
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

    public function autenticaLocalizacaoApi(){

        // return $dados;
        $sessionTokenExitvs = session('tokenExitvs');
        if(session('tokenExitvs')){
            $sessionTokenExitvs = session('tokenExitvs');
            if(date('Y-m-dTh:i:s')>$sessionTokenExitvs->expiryDate){
                // $sessionTokenExitvs = $this->autenticaLocalizacaoApi();
                $sessionTokenExitvs = $this->curlAutenticaExitvs();
                echo 'autenticando...';
            }
        }else{
            $sessionTokenExitvs = $this->curlAutenticaExitvs();
        }

        return $sessionTokenExitvs->token;
    }


    public function curlAutenticaExitvs(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api.exitvs.com.br/Autenticar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{ "username" : "bem" , "password" : "EA4790076BCC4FBF89ED36A050761C43"}',
            CURLOPT_HTTPHEADER => array(
            //     'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9uYW1lIjoiQmVtIFRyYW5zcG9ydGVzIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiMTk3MjE2NSIsIm5iZiI6MTY5MzUxMjQxNiwiZXhwIjoxNjkzNTk4ODE2LCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjUzOTYxLyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTM5NjEvIn0.yyZWEC9yv3xKM3HiHkKG2TdhYm38Zbd1dKR-rkV6suc',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $dados = json_decode($response);
        session(['tokenExitvs' => $dados]);
        return $dados;
    }

    public function getLocalizacaoVeiculo($equipamento)
    {
        // curl -X POST "http://api.exitvs.com.br/v1/Localizacao" -H "accept: text/plain" -H "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9uYW1lIjoiQmVtIFRyYW5zcG9ydGVzIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiMTk3MjE2NSIsIm5iZiI6MTY5MzUxMjQxNiwiZXhwIjoxNjkzNTk4ODE2LCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjUzOTYxLyIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTM5NjEvIn0.yyZWEC9yv3xKM3HiHkKG2TdhYm38Zbd1dKR-rkV6suc";
        // return view('admin.telas.veiculo.localizacaoVeiculo',['veiculo'=>$veiculo]);

        // echo $dataAtual =  date("Y-m-d h:i:s");echo '<br />';
        $diaAtual = date('d');
        $mesAtual = date('m');
        $anoAtual = date('Y');
        $horaAtual = date('H');
        $minutoAtual = date('i');
        $segundoAtual = date('s');

        $dataAtuaMenosMinutos =  date("Y-m-d H:i:s", strtotime("-1 hours"));
        $diaAtualMenosMinutos = date('d', strtotime($dataAtuaMenosMinutos));
        $mesAtualMenosMinutos = date('m', strtotime($dataAtuaMenosMinutos));
        $anoAtualMenosMinutos = date('Y', strtotime($dataAtuaMenosMinutos));
        $horaAtualMenosMinutos = date('H', strtotime($dataAtuaMenosMinutos));
        $minutoAtualMenosMinutos = date('i', strtotime($dataAtuaMenosMinutos));
        $segundoAtualMenosMinutos = date('s', strtotime($dataAtuaMenosMinutos));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api.exitvs.com.br/v1/Localizacao/historico',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS => '{ "idEquipamento" : '.$equipamento.' , "inicio" : '.$dataAtuaMenosMinutos.' , "fim" : '.$dataAtual.' }',
            CURLOPT_POSTFIELDS => '{ "idEquipamento" : '.$equipamento.' , "inicio" : "'.$anoAtualMenosMinutos.'-'.$mesAtualMenosMinutos.'-'.$diaAtualMenosMinutos.'T'.$horaAtualMenosMinutos.':'.$minutoAtualMenosMinutos.':'.$segundoAtualMenosMinutos.'" , "fim" : "'.$anoAtual.'-'.$mesAtual.'-'.$diaAtual.'T'.$horaAtual.':'.$minutoAtual.':'.$segundoAtual.'" }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->autenticaLocalizacaoApi(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $obj = json_decode($response);
        curl_close($curl);
        // echo $response;
        return view('veiculo.localizacao.show',['veiculo'=>$obj]);
    }

    public function monitorarVeiculo($veiculo)
    {
        // $Veiculo = Veiculo::where('placa',$veiculo)->get();
        // if($Veiculo->count()!=0){
            return view('veiculo.monitoramento.show',['veiculo'=>$veiculo]);
        // }else{
        //     return response()->json(['status'=>0,'msg'=>'sem informações deste veiculo']);
        // }
    }

    public function getDadosAjaxLocationVeiculo($veiculo)
    {

        $cr = curl_init();
        $headr = array();
        $headr[] = 'Content-length: 0';
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . $this->autenticaLocalizacaoApi();
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($cr, CURLOPT_URL, "http://api.exitvs.com.br/v1/Localizacao");
        curl_setopt($cr, CURLOPT_POST, TRUE);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        $obj = json_decode($retorno);
        $encontrado = [];
        foreach($obj as $item){
            if($item->placa == $veiculo){
                $encontrado['dados']=[
                    'placa'=>$item->placa,
                    'endereco'=>$item->endereco,
                    'id_equipamento'=>$item->id_equipamento,
                    'bateria'=>$item->bateria,
                    'latitude'=>$item->latitude,
                    'longitude'=>$item->longitude,
                    'descricao'=>$item->descricao,
                    'dataHoraLocalizacao'=>date('d/m/Y H:i:s', strtotime($item->dataHoraLocalizacao)),
                    'dataUpdate'=>date('d/m/Y H:i:s', strtotime($item->dataUpdate)),
                    'ignicao'=>$item->ignicao,
                    'velocidade'=>$item->velocidade,
                    'updateLocal'=>date('d/m/Y H:i:s'),
                ];
            }
        }
        return view('veiculo.monitoramento.cards-monitoring',['dados'=>$encontrado]);
        // if(count($encontrado)!=0){
        //     return response()->json(['status'=>200,'msg'=>$encontrado]);
        // }else{
        //     return response()->json(['status'=>0,'msg'=>'sem informacoes']);
        // }
    }
    public function getDadosAjaxMapsLocationVeiculo($veiculo){
        $cr = curl_init();
        $headr = array();
        $headr[] = 'Content-length: 0';
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . $this->autenticaLocalizacaoApi();
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($cr, CURLOPT_URL, "http://api.exitvs.com.br/v1/Localizacao");
        curl_setopt($cr, CURLOPT_POST, TRUE);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        $obj = json_decode($retorno);
        $encontrado = [];
        foreach($obj as $item){
            if($item->placa == $veiculo){
                $encontrado=[
                    'placa'=>$item->placa,
                    'endereco'=>$item->endereco,
                    'id_equipamento'=>$item->id_equipamento,
                    'bateria'=>$item->bateria,
                    'latitude'=>$item->latitude,
                    'longitude'=>$item->longitude,
                    'descricao'=>$item->descricao,
                    'dataHoraLocalizacao'=>date('d/m/Y H:i:s', strtotime($item->dataHoraLocalizacao)),
                    'dataUpdate'=>date('d/m/Y H:i:s', strtotime($item->dataUpdate)),
                    'ignicao'=>$item->ignicao,
                    'velocidade'=>$item->velocidade,
                    'updateLocal'=>date('d/m/Y H:i:s'),
                ];
            }
        }
        return response()->json(['dados'=>$encontrado]);
    }
    public function getDadosAjaxMapsLocationTodosVeiculos(){
        $cr = curl_init();
        $headr = array();
        $headr[] = 'Content-length: 0';
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . $this->autenticaLocalizacaoApi();
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($cr, CURLOPT_URL, "http://api.exitvs.com.br/v1/Localizacao");
        curl_setopt($cr, CURLOPT_POST, TRUE);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        $obj = json_decode($retorno);
        $encontrado = [];
        foreach($obj as $item){
            // if($item->placa == $veiculo){
                $encontrado[]=[
                    'placa'=>$item->placa,
                    'endereco'=>$item->endereco,
                    'id_equipamento'=>$item->id_equipamento,
                    'bateria'=>$item->bateria,
                    'latitude'=>$item->latitude,
                    'longitude'=>$item->longitude,
                    'descricao'=>$item->descricao,
                    'dataHoraLocalizacao'=>date('d/m/Y H:i:s', strtotime($item->dataHoraLocalizacao)),
                    'dataUpdate'=>date('d/m/Y H:i:s', strtotime($item->dataUpdate)),
                    'ignicao'=>$item->ignicao,
                    'velocidade'=>$item->velocidade,
                    'updateLocal'=>date('d/m/Y H:i:s'),
                ];
            // }
        }
        return response()->json(['dados'=>$encontrado]);
    }

    public function getDadosAjaxMapsLocationVeiculoEntrega($veiculo)
    {
        $cr = curl_init();
        $headr = array();
        $headr[] = 'Content-length: 0';
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . $this->autenticaLocalizacaoApi();
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($cr, CURLOPT_URL, "http://api.exitvs.com.br/v1/Localizacao");
        curl_setopt($cr, CURLOPT_POST, TRUE);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        $obj = json_decode($retorno);
        $encontrado = [];
        $destinos = [];
        foreach($obj as $item){
            if($item->placa == $veiculo){
                $encontrado=[
                    'placa'=>$item->placa,
                    'endereco'=>$item->endereco,
                    'id_equipamento'=>$item->id_equipamento,
                    'bateria'=>$item->bateria,
                    'latitude'=>$item->latitude,
                    'longitude'=>$item->longitude,
                    'descricao'=>$item->descricao,
                    'dataHoraLocalizacao'=>date('d/m/Y H:i:s', strtotime($item->dataHoraLocalizacao)),
                    'dataUpdate'=>date('d/m/Y H:i:s', strtotime($item->dataUpdate)),
                    'ignicao'=>$item->ignicao,
                    'velocidade'=>$item->velocidade,
                    'updateLocal'=>date('d/m/Y H:i:s'),
                ];
                //selecionar o carro pela placa
                $Veiculo =  Veiculo::where('placa',$veiculo)->get()->first()->id;
                $Cargas = Entrega::where('veiculo_id',$Veiculo)->get()->first()->cargas;
                foreach($Cargas as $carga)
                {
                    foreach($carga->notas as $nota)
                    {
                        $destinatario = $nota->destinatario;
                        $destinos[] = [
                            'destinatario'=>['nome'=>$destinatario->nome_razao_social,
                            'coordenadas'=> CEP::getCoordenadaCep($destinatario->endereco->cep)
                            ]
                        ];
                    }
                }
            }
        }
        return response()->json(['dados'=>$encontrado,'destinos'=>$destinos]);
    }
    public function rastrearTodosVeiculos()
    {
        return view('veiculo.monitoramento.index');
    }


    public function getLocationMaps()
    {
        // return
    }

    public function getDadosAjaxLocationTodosVeiculos()
    {
        // return response()->json(['status'=>200,'msg'=>'teste']);
        $cr = curl_init();
        $headr = array();
        $headr[] = 'Content-length: 0';
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: Bearer ' . $this->autenticaLocalizacaoApi();
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($cr, CURLOPT_URL, "http://api.exitvs.com.br/v1/Localizacao");
        curl_setopt($cr, CURLOPT_POST, TRUE);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        $obj = json_decode($retorno);
        $encontrado = [];
        foreach($obj as $item){
            // if($item->placa == $veiculo){
                $encontrado[]=[
                    'placa'=>$item->placa,
                    'endereco'=>$item->endereco,
                    'id_equipamento'=>$item->id_equipamento,
                    'bateria'=>$item->bateria,
                    'latitude'=>$item->latitude,
                    'longitude'=>$item->longitude,
                    'descricao'=>$item->descricao,
                    'dataHoraLocalizacao'=>date('d/m/Y H:i:s', strtotime($item->dataHoraLocalizacao)),
                    'dataUpdate'=>date('d/m/Y H:i:s', strtotime($item->dataUpdate)),
                    'ignicao'=>$item->ignicao,
                    'velocidade'=>$item->velocidade,
                    'updateLocal'=>date('d/m/Y H:i:s'),
                ];
            // }
        }
        // return response()->json(['status'=>200,'msg'=>$encontrado]);
        return view('veiculo.monitoramento.cards-monitoring',['dados'=>$encontrado]);
        // if(count($encontrado)!=0){
        // }else{
        //     return response()->json(['status'=>0,'msg'=>'sem informacoes']);
        // }
    }


    public function registraAltaVelocidade($veiculo, $velocidade)
    {
        return response()->json(['status'=>200,'msg'=>$velocidade]);
    }

}
