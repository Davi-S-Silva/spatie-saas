<?php

namespace App\Models;

// use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class LocalMovimentacao extends Model
{
    use HasRoles;

    public function newId(){
        $count = $this->all();
        if($count->count()==0){
            $this->id = 1;
        }else{
            $this->id = $this->all()->last()->id +=1;
        }
    }

    public function movimentacoes(){
        return $this->hasOne(MovimentacaoVeiculo::class);
    }

    public function filials()
    {
        return $this->belongsToMany(Filial::class);
    }
    public function locaisapoios()
    {
        return $this->belongsToMany(LocalApoio::class);
    }

    public static function getLocalMovimentacao($local)
    {
        return LocalMovimentacao::where('title',$local)->get()->first();
    }

    public function getStatusId($status)
    {
        return Status::where('name',$status)->where('tipo',6)->get()->first()->id;
    }
    public function tentants()
    {
        return $this->belongsToMany(Tenant::class);
    }
}
