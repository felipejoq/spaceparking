<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nodemcu extends Model
{

    protected $fillable = [
         'nodemcu_clave',
        ];

    public function ocupaciones(){
        return $this->hasMany(Ocupacion::class);
    }

    public function plazas(){
        return $this->hasMany(Plaza::class);
    }
}
