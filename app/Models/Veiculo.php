<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Veiculo extends Model
{
    use HasFactory,HasRoles;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }
}
