<?php

namespace App\Models;

// use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class IndicacaoPagamento extends Model
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
    public static function getIndPagamento($id){
        return IndicacaoPagamento::find($id)->descricao;
    }
}
