<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Endereco extends Model
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

    protected $fillable = [
        'rua','numero','bairro','cep','cidade_id','estado_id'
    ];
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class);
    }


    public function filiais()
    {
        return $this->belongsToMany(Filial::class);
    }

    public function colaborador()
    {
        return $this->belongsToMany(Colaborador::class);
    }

    public function destinatario()
    {
        return $this->hasOne(Nota::class);
    }
    public function cidade()
    {
        return $this->belongsTo(Municipio::class);
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
