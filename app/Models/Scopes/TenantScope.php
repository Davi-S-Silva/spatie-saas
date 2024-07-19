<?php

namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model)
    {
        if(session()->has('tenant_id') && !is_null(session('tenant_id'))){
            $builder->where('tenant_id',session('tenant_id'));
        }
        else{
            if(session()->has('noTenatable')){
                $builder->where('tenant_id',null);
            }
            if($model->getActualClassNameForMorph($model::class) != $model->getActualClassNameForMorph(User::class)){
                $builder->where('tenant_id',null);
            }
        }
    }
}
