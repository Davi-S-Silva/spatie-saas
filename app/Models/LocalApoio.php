<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class LocalApoio extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = ['name','description','empresa_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function colaboradores():HasMany
    {
        return $this->hasMany(Colaborador::class);
    }
}
