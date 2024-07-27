<?php

namespace App\Models;

// use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class TipoPagamento extends Model
{
    use HasRoles;
    public static function getTipoPagamentoByCodigo($codigo)
    {
        return TipoPagamento::where('codigo',$codigo)->get()->first()->descricao;
    }
}
