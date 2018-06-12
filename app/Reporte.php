<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{


    public function plaza(){
        return $this->belongsTo(Plaza::class);
    }
}
