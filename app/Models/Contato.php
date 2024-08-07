<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Contato extends Model
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
