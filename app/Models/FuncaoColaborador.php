<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class FuncaoColaborador extends Model
{
    use Tenantable,HasRoles;
}
