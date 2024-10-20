<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Carga extends Model
{
    use Tenantable,HasRoles;

   public function newId(){
        //contando excluindo o global scope
        $count = $this->withoutGlobalScopes()->get();
        if($count->count()==0){
            $this->id = 1;
        }else{
          $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
        }
    }


    public function setNotas($notas)
    {
        // return $notas;
        return (new Nota())->getNotas($notas, $this);
        // return $this;
    }

    public function notas():HasMany
    {
        return $this->hasMany(Nota::class);
    }

    public function comprovanteNotas()
    {
        $notas = $this->notas()->get();
        $paths = [];
        foreach($notas as $nota){
            foreach($nota->comprovantes()->get() as $comprovante){
                $paths[] = $comprovante->path;
            }
        }
    }
    public function comprovanteNotasSemTaNoBd()
    {
        $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));
        $directory = 'app/public/'.$empresa.'/arquivos/notas/comprovantes/';
        $files = Storage::files($directory);
        $notas = $this->notas()->get();
        $paths = [];
        foreach ($notas as $nota) {
            foreach ($files as $file) {
                if(str_contains($file, $nota->nota)){
                    $paths[] = $file;
                }
            }
        }
        $dados = array_unique($paths);
        return $dados;

    }

    public function notasPorStatus($status){
        return Nota::where('carga_id',$this->id)->where('status_id',(new Nota())->getStatusId($status))->get();
    }
    public function porcentagemNotas()
    {
        $totalNotas = $this->notas()->count();
        $devolvidas = $this->notasPorStatus('devolvida')->count();
        $entregues = $this->notasPorStatus('entregue')->count();
        $somaNotas = ($devolvidas+$entregues);
        $percent = 0;
        if($somaNotas != 0){
            $percent = $somaNotas / $totalNotas;
        }
        return  number_format( $percent * 100, 0 ) . '%';
    }
    public function motorista()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    public function entregas()
    {
        return $this->belongsToMany(Entrega::class);
    }
    public function getStatusId($status)
    {
        return Status::where('name',$status)->where('tipo',1)->get()->first()->id;
    }
    public function getAllStatus()
    {
        return Status::where('tipo',1)->get();
    }

    public function getStatus(){
        return Status::find($this->status_id);
    }

    public function setStatus($status){
        $this->status_id = Status::where('name',$status)->where('tipo',1)->get()->first()->id;
    }

    public function countNotasPendentes()
    {
        return Nota::where('carga_id',$this->id)->where('status_id',(new Nota())->getStatusId('Pendente'))->count();
    }

    public function localApoio()
    {
        return $this->belongsTo(LocalApoio::class);
    }

    public function cidades()
    {
        $notas = $this->notas()->with('destinatario','destinatario.endereco','destinatario.endereco.cidade','destinatario.endereco.estado');

        $array = [];
        foreach($notas->get() as $nota){
            $array[] = $nota->destinatario->endereco->cidade;
        }
        // dd($array);
        return array_unique($array);
    }
    public function distanceCity()
    {
        $maior = array();
        // $cliente  = Cliente::find($Carga->cliente_id);
        foreach ($this->cidades() as $cidade) {
            $distancia = (new DistanceCity($cidade->getCoordenadas($this->filial->enderecos->first()->cidade->codigo), "$cidade->longitude,$cidade->latitude"))->showDistance();
            array_push($maior, [$distancia, $cidade]);
        }
        sort($maior);
        $CidadeFinal = end($maior)[1];
        return $CidadeFinal;

    }
    public function distanceLastNote()
    {
        $notas = $this->notas()->with('destinatario','destinatario.endereco','destinatario.endereco.cidade','destinatario.endereco.estado');
        $maior = array();
        $array = [];
        $notas = $notas->get();
        foreach( $notas as $nota){
            $array[] = $nota->destinatario->endereco->cidade;
        }
        // dd($array);
        array_unique($array);
        // dd($dados);
        foreach ($this->cidades() as $cidade) {
            $distancia = (new DistanceCity($cidade->getCoordenadas($this->filial->enderecos->first()->cidade->codigo), "$cidade->longitude,$cidade->latitude"))->showDistance();
            array_push($maior, [$distancia, $cidade]);
        }
        // return ;
        sort($maior);
        $CidadeFinal = end($maior)[1];
        // dd($CidadeFinal);
        foreach($notas as $nota){
            if($nota->destinatario->endereco->cidade->codigo == $CidadeFinal->codigo){
                return $nota;
                // dd($nota);
            }
        }
    }

    public function paradas()
    {
        $notas = $this->notas()->with('destinatario');
        $array = [];
        foreach($notas->get() as $nota){
            $array[] = $nota->destinatario->id;
        }
        // dd($array);
        return array_unique($array);
    }
    public function pesoBruto(){
        // return DB::raw();
        return $this->notas()->sum('pesoBruto');
    }
    public function pesoLiquido(){
        // return DB::raw();
        return $this->notas()->sum('pesoLiquido');
    }
    public function peso(){
        // return DB::raw();
        $pesoBruto  = $this->pesoBruto();
        $pesoLiquido  = $this->pesoLiquido();
        $peso = 0;
        if($pesoBruto> $pesoLiquido){
            $peso = $pesoBruto;
        }else{
            $peso = $pesoLiquido;
        }
        return $peso;
    }
    public function valor(){
        // return DB::raw();
        return $this->notas()->sum('valor');
    }
    public function quantidade(){
        // return DB::raw();
        return $this->notas()->sum('volume');
    }
    public function produtos()
    {
        $dados = [];
        $notas=$this->notas()->with('produtos');
        $somaProd = 0;
        if($notas->count()==0){
            return null;
        }
        foreach($notas->get() as $nota)
        {
            $produtos = $nota->produtos;
            if($produtos->count()==0){
                return null;
            }

            foreach($produtos as $produto){
                $dados['item'][$produto->nome]['nome']= $produto->nome;
                $somaProd += $produto->quantidade;
                $dados['item'][$produto->nome]['quantidade'][] = $produto->quantidade;
                $qtd = $dados['item'][$produto->nome]['quantidade'];
                $somaProd=0;
                for($i=0 ;$i<count($qtd);$i++){
                    $somaProd+=$qtd[$i];
                }
                $dados['item'][$produto->nome]['total_produto'] = $somaProd;
            }
        }
        // $dados['total_volume_carga'] = $totalVolumeCarga;
        // dd($dados['item']);
        return $dados['item'];
    }

    public function historico()
    {
        return Historico::where('model', 'Carga')->where('id_model',$this->id)->get();
    }
    // public function dadosHistorico(){

    // }
    public function docs()
    {
        return $this->hasMany(FileCarga::class);
    }
    public function getDoc($doc,$name,$download=false){
        // $empresa = str_replace(' ', '', strtolower(Auth::user()->empresa->first()->nome));
        $fileCarga = FileCarga::where('carga_id',$this->id)->where('tipo',ucfirst($doc))->where('name',$name)->get()->first();
        // $name = '';
        $filePath =$fileCarga->path;
        if( $fileCarga->count()!=0){
            if($download){
                return Storage::temporaryUrl(
                    $filePath,
                    now()->addHour(),
                    ['ResponseContentDisposition' => 'contentDisposition']
                );
            }else{
                return Storage::temporaryUrl(
                    $filePath,
                    now()->addHour(),
                    // ['ResponseContentDisposition' => 'contentDisposition']
                );
            }
        }else{
            return false;
        }
    }
    public function setHistorico($msg){
        $historico = new Historico();
        $historico->newId();
        $historico->model = 'Carga';
        $historico->id_model = $this->id;
        $historico->descricao = $msg;
        $historico->dados = $this;
        $historico->data = date('Y-m-d');
        $historico->user_id = Auth::user()->id;
        $historico->tenant_id = Auth::user()->tenant_id;
        $historico->save();
    }

}
