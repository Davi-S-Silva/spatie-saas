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
        $notas = $this->notas()->with('destinatario','destinatario.endereco','destinatario.endereco.cidade');

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
    public function valor(){
        // return DB::raw();
        return $this->notas()->sum('valor');
    }
}
