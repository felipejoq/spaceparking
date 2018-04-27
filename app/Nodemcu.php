<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nodemcu extends Model
{
    public function ocupaciones(){
        return $this->hasMany(Ocupacion::class);
    }
}
