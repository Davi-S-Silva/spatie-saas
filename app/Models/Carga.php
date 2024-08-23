<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
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
}
