<?php

namespace App\Models;

// use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Tenant extends Model
{
    // use HasRoles, Tenantable;
    use HasRoles;
    protected $guarded = ['id'];

    public function newId(){
        $count = $this->all();
        if($count->count()==0){
            $this->id = 1;
        }else{
            $this->id = $this->all()->last()->id +=1;
        }
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function fornecedor()
    {
        return $this->belongsToMany(Fornecedor::class);
    }
    public function localMovimentacao()
    {
        return $this->belongsToMany(LocalMovimentacao::class);
    }
}
