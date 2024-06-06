<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Contato extends Model
{
    use HasFactory,HasRoles;

    public function empresas(){
        return $this->belongsToMany(Empresa::class);
    }
}
