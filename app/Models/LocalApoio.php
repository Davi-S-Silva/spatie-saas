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
