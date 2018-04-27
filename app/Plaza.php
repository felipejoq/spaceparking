<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{

    public function ocupaciones(){
        return $this->hasMany(Ocupacion::class);
    }

    public function  totalPlazas(){
        return $this->count();
    }

}
