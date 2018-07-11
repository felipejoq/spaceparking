<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $hidden = ['updated_at'];

    public function plaza(){
        return $this->belongsTo(Plaza::class);
    }

    public function nodemcu(){
        return $this->belongsTo(Nodemcu::class);
    }
}
