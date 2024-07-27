<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class LocalApoio extends Model
{
    use Tenantable,HasRoles;

    protected $fillable = ['name','description','empresa_id'];
    public function newId(){
        //contando excluindo o global scope
        $count = $this->withoutGlobalScopes()->get();
        if($count->count()==0){
            $this->id = 1;
        }else{
          $this->id = $this->withoutGlobalScopes()->get()->last()->id +=1;
        }

    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function colaboradores():HasMany
    {
        return $this->hasMany(Colaborador::class);
    }

    public function locaismovimetacoes()
    {
        return $this->belongsToMany(LocalMovimentacao::class);
    }
}
