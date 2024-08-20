<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoNota extends Model
{
    // use HasRoles;
    public function newId()
    {
        $count = $this->all();
        if ($count->count() == 0) {
            $this->id = 1;
        } else {
            $this->id = $this->all()->last()->id += 1;
        }
    }
}
