<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Abastecimento extends Model
{
    use HasRoles, Tenantable;
    protected $guarded = ['id'];

    protected $fillable = [
        'tenant_id',
    ];
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
        return $this->belongsTo(Colaborador::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function combustivel()
    {
        return $this->belongsTo(Combustivel::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
    public function media()
    {
        $abastecimento = $this;
        $kmRodado = $abastecimento->kmAtual - $abastecimento->kmAnterior;
        $media = $kmRodado / $abastecimento->litros;
        return $media;
    }
}
