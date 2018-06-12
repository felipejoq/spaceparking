<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    protected $fillable = [

        'numero_plaza','descripcion','tipo_id','nodemcu_id','estado_inicial'

        ];

    public function ocupaciones(){
        return $this->hasMany(Ocupacion::class);
    }

    public function  totalPlazas(){
        return $this->count();
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class,'tipo_id');
    }

    public function nodemcu(){
        return $this->belongsTo(Nodemcu::class,'nodemcu_id');
    }

    public function reportes(){
        return $this->hasMany(Reporte::class);
    }

}
