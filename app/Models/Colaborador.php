<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Colaborador extends Model
{
    use HasFactory,HasRoles;
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
}
