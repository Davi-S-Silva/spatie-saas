<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class LocalApoio extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = ['name','description','empresa_id'];

    public function empresa()
    {
        return $this->belongsToMany(Empresa::class);
    }
}
