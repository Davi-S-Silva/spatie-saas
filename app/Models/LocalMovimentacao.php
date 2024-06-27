<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class LocalMovimentacao extends Model
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

    public function movimentacoes(){
        return $this->hasOne(MovimentacaoVeiculo::class);
    }

    public function filials()
    {
        return $this->belongsToMany(Filial::class);
    }
    public function locaisapoios()
    {
        return $this->belongsToMany(LocalApoio::class);
    }
}
