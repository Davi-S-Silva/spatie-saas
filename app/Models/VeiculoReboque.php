<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class VeiculoReboque extends Model
{
    use Tenantable,HasRoles;
}
