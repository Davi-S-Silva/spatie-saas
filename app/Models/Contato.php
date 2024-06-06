<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Contato extends Model
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

    public function empresas(){
        return $this->belongsToMany(Empresa::class);
    }
    public function filiais()
    {
        return $this->belongsToMany(Filial::class);
    }

    public function colaborador(){
        return $this->belongsToMany(Colaborador::class);
    }


}
