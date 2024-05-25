<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Certificado extends Model
{
    use HasFactory,HasRoles;

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

}
