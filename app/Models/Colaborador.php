<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Colaborador extends Model
{
    use Tenantable,HasRoles;
    public function newId(){
        $count = $this->all();
        if($count->count()==0){
            $this->id = 1;
        }else{
            $this->id = $this->all()->last()->id +=1;
        }
    }

    public function contatos()
    {
        return $this->belongsToMany(Contato::class);
    }
    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class);
    }
    public function localApoio()
    {
        return $this->belongsTo(LocalApoio::class);
    }

    public function carga()
    {
        return $this->hasMany(Carga::class);
    }

    // public function entregas(){
    //     return $this->belongsToMany(Entrega::class);
    // }

    public function entregas(){
        return $this->hasMany(Entrega::class);
    }


    public function status($status)
    {
        return Status::where('name',$status)->where('tipo',5)->get()->first()->id;
    }

    public function getStatus(){
        return Status::find($this->status_id);
    }

    public function setStatus($status){
        $this->status_id = Status::where('name',$status)->where('tipo',5)->get()->first()->id;
    }
}
