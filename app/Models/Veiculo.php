<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Veiculo extends Model
{
    use Tenantable,HasRoles;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }

    public function movimentacaos()
    {
        return $this->hasMany(MovimentacaoVeiculo::class);
    }
    public function status($status)
    {
        return Status::where('name',$status)->where('tipo',2)->get()->first()->id;
    }

    public function getStatus(){
        return Status::find($this->status_id);
    }

    public function setStatus($status){
        $this->status_id = Status::where('name',$status)->where('tipo',2)->get()->first()->id;
    }
}
