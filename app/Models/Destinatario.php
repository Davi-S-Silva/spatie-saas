<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Destinatario extends Model
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

    public function nota():HasMany
    {
        return $this->hasMany(Nota::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }
}
