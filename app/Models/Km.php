<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class Km extends Model
{
    use HasRoles;
    protected $guarded = ['id'];

    public function newId(){
        //contando excluindo o global scope
        $count = $this->withoutGlobalScopes()->get();
        if($count->count()==0){
            $this->id = 1;
        }else{
          $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
        }
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function setKm(Veiculo $veiculo, $km)
    {
        //antes de atribuir valida se o km é maior que o km anterior
        $kmAnterior = (!is_null($veiculo->kms()) && $veiculo->kms()->count()!=0)?$veiculo->kms()->get()->last()->km:0;
        // throw new Exception($km. ' - '.$kmAnterior);
        if($km<$kmAnterior){
            throw new Exception('Km Atual não pode ser menor que o Km Anterior');
        }
        $this->usuario_id = Auth::user()->id;
        $this->km = $km;
        $this->veiculo_id = $veiculo->id;
    }

    public function abastecimentos()
    {
        return $this->belongsToMany(MovimentacaoVeiculo::class);
    }

    // public function movimentacaos()
    // {
    //     // return $this->belongsTo(MovimentacaoVeiculo::class);
    //     return $this->hasOne(MovimentacaoVeiculo::class);
    // }
}
