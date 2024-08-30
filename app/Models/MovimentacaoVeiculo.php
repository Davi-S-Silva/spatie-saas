<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

class MovimentacaoVeiculo extends Model
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

    public function partida(){
        return $this->belongsTo(LocalMovimentacao::class,'Local_partida_id');
    }
    public function destino(){
        return $this->belongsTo(LocalMovimentacao::class,'Local_destino_id');
    }
    public function veiculo(){
        return $this->belongsTo(Veiculo::class);
    }

    public function colaborador(){
        return $this->belongsTo(Colaborador::class);
    }

    public function getStatusId($status)
    {
        return Status::where('name',$status)->where('tipo',3)->get()->first()->id;
    }

    public function getStatus(){
        // return Status::find($this->status_id);
        return $this->belongsTo(Status::class,'status_id');
    }

    public function setStatus($status){
        $this->status_id = Status::where('name',$status)->where('tipo',3)->get()->first()->id;
    }

    public static function getMovimentacaoVeiculo($veiculo)
    {
        return MovimentacaoVeiculo::where('veiculo_id',$veiculo)->get();
        // $mov = new MovimentacaoVeiculo();
        // return $mov->status($status);
    }

    public function kms()
    {
        return $this->hasMany(Km::class);
    }

    public function kmInicio()
    {
        return $this->belongsTo(Km::class,'km_inicio_id');
    }
    public function kmFim()
    {
        return $this->belongsTo(Km::class,'km_fim_id');
    }

}
