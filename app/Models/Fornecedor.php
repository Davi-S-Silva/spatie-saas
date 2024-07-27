<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Fornecedor extends Model
{
    use Tenantable,HasRoles;

    public function contatos()
    {
        return $this->belongsToMany(Contato::class);
    }
}
