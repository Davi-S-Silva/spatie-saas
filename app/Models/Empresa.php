<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

class Empresa extends Model
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

    public function certificate(): HasMany
    {
        return $this->hasMany(Certificado::class);
    }

    public function localapoios():HasMany
    {
        return $this->hasMany(LocalApoio::class);
    }

    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class);
    }

    public function contatos()
    {
        return $this->belongsToMany(Contato::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
