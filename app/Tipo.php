<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    public function plazas(){
        return $this->hasMany(Plaza::class);
    }
}
