<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Manutencao extends Model
{
    use HasRoles, Tenantable;
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
    public function getStatusId($status)
    {
        return Status::where('name',$status)->where('tipo',8)->get()->first()->id;
    }

    public function servicos()
    {
        return $this->hasMany(ServicoManutencao::class);
    }
    public function observacoes()
    {
        return $this->belongsToMany(Observacao::class);
    }
}
