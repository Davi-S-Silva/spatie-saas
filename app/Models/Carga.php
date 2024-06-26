<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Carga extends Model
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


    public function setNotas($notas)
    {
        return (new Nota())->getNotas($notas, $this);
        // return $this;
    }

    public function notas():HasMany
    {
        return $this->hasMany(Nota::class);
    }

    public function motorista()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    public function entregas()
    {
        return $this->belongsToMany(Entrega::class);
    }
}
