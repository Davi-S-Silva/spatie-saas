<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

class Empresa extends Model
{
    use HasFactory,HasRoles;

    public function certificate(): HasMany
    {
        return $this->hasMany(Certificado::class);
    }

    public function localapoio():HasMany
    {
        return $this->hasMany(LocalApoio::class);
    }

    public function endereco():HasMany
    {
        return $this->hasMany(Endereco::class);
    }
}
