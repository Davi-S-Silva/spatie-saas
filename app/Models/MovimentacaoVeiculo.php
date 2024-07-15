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
        $count = $this->all();
        if($count->count()==0){
            $this->id = 1;
        }else{
            $this->id = $this->all()->last()->id +=1;
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

    public function status($status)
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
}
