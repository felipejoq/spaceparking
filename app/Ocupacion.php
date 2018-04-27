<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $hidden = ['plaza_id','nodemcu_id'];

    public function plaza(){
        return $this->belongsTo(Plaza::class);
    }

    public function nodemcu(){
        return $this->belongsTo(Nodemcu::class);
    }
}
