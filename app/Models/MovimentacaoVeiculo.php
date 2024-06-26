<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MovimentacaoVeiculo extends Model
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

    public function partida(){
        return $this->belongsTo(LocalMovimentacao::class,'id','Local_partida_id');
    }

    public function colaborador(){
        return $this->belongsTo(Colaborador::class);
    }
}
