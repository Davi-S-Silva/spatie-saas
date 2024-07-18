<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Entrega extends Model
{
    use Tenantable,HasRoles;
    // protected $fillable = [];
   public function newId(){
        //contando excluindo o global scope
        $count = $this->withoutGlobalScopes()->get();
        if($count->count()==0){
            $this->id = 1;
        }else{
          $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
        }
    }

    public function cargas()
    {
        return $this->belongsToMany(Carga::class);
    }

    public function ajudantes()
    {
        return $this->belongsToMany(Colaborador::class);
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function getStatusId($status)
    {
        return Status::where('name',$status)->where('tipo',4)->get()->first()->id;
    }

    public function getStatus(){
        // return Status::find($this->status_id);
        return $this->belongsTo(Status::class,'status_id');
    }

    public function setStatus($status){
        $this->status_id = Status::where('name',$status)->where('tipo',4)->get()->first()->id;
    }

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }
}
