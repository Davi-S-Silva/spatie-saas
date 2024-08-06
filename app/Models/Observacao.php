<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Observacao extends Model
{
    use Tenantable,HasRoles;

    // public function __construct($text)
    // {
    //     $this->descricao = $text;
    // }
    public function notas()
    {
        return $this->belongsToMany(Nota::class);
    }
}
