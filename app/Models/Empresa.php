<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

class Empresa extends Model
{
    use HasFactory,HasRoles;

    public function newId(){
        $count = $this->all();
        if($count->count()==0){
            $this->id = 1;
        }
        else{
            $this->id = $this->all()->last()->id +=1;
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
