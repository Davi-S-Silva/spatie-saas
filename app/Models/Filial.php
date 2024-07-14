<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Filial extends Model
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

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }
    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class);
    }
    public function contatos()
    {
        return $this->belongsToMany(Contato::class);
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }

    public function locaismovimetacoes()
    {
        return $this->belongsToMany(LocalMovimentacao::class);
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
