<?php

namespace App\Models;

// use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class TipoDoc extends Model
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

    public function colaborador()
    {
        return $this->belongsToMany(Colaborador::class);
    }
    public static function getTipoDocId($name)
    {
        return TipoDoc::where('name',$name)->get()->first()->id;
    }
}
