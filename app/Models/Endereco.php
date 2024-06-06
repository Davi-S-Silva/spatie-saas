<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Endereco extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = [
        'rua','numero','bairro','cep','cidade_id','estado_id'
    ];
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class);
    }

    public function newId(){
        $count = Endereco::all();
        if($count->count()==0){
            return 1;
        }
        return Endereco::all()->last()->id +=1;
    }
}
