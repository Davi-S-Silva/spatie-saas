<?php

namespace App\Models;

// use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Fornecedor extends Model
{
    use HasRoles;

    public function newId(){
        //contando excluindo o global scope
        $count = $this->withoutGlobalScopes()->get();
        if($count->count()==0){
            $this->id = 1;
        }else{
          $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
        }
    }

    public function contatos()
    {
        return $this->belongsToMany(Contato::class);
    }
    public function tentants()
    {
        return $this->belongsToMany(Tenant::class);
    }
}
