<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacionamiento extends Model
{


    public function administradores(){
        return $this->hasMany(User::class);
    }

}
