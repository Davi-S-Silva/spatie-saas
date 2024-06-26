<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Entrega extends Model
{
    use HasFactory,HasRoles;
    // protected $fillable = [];
    public function newId(){
        $count = $this->all();
        if($count->count()==0){
            $this->id = 1;
        }
        else{
            $this->id = $this->all()->last()->id +=1;
        }
    }

    public function cargas()
    {
        return $this->belongsToMany(Carga::class);
    }

    public function ajudantes()
    {
        return $this->belongsToMany(Colaborador::class);
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function status()
    {
        return Status::find($this->status_id)->name;
    }
}
