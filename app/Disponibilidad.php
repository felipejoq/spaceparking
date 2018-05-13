<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Disponibilidad extends Model
{
    //protected $hidden = ['plaza_id','id'];

    public function agregaPlazaDisponibilidad(Plaza $plaza){

        $disponibilidad = Disponibilidad::latest()->first();
        $disponibilidad->total_plazas = $disponibilidad->total_plazas + 1;

        if ($plaza->estado_inicial == "Disponible"){
            $disponibilidad->plazas_libres = $disponibilidad->plazas_libres + 1;
        }else{
            $disponibilidad->plazas_ocupadas = $disponibilidad->plazas_ocupadas + 1;
        }

        $disponibilidad->plaza_id = $plaza->id;

        $disponibilidad->save();

    }

    public function actualizaPlazaDisponibilidad(Request $request, Plaza $plaza){

        $disponibilidad = Disponibilidad::latest()->first();

        if ($request->estado_inicial != $plaza->estado_inicial){

            if ($request->estado_inicial == 'Disponible' && $plaza->estado_inicial == 'No disponible'){
                $disponibilidad->plazas_libres = $disponibilidad->plazas_libres + 1;
                $disponibilidad->plazas_ocupadas = $disponibilidad->plazas_ocupadas - 1;
            }

            if ($request->estado_inicial == 'No disponible' && $plaza->estado_inicial == 'Disponible'){
                $disponibilidad->plazas_libres = $disponibilidad->plazas_libres - 1;
                $disponibilidad->plazas_ocupadas = $disponibilidad->plazas_ocupadas + 1;
            }

        }

        $disponibilidad->plaza_id = $plaza->id;

        $disponibilidad->save();

    }

    public function eliminaPlazaDisponibilidad(Plaza $plaza){

        $disponibilidad = Disponibilidad::latest()->first();

        $disponibilidad->total_plazas = $disponibilidad->total_plazas - 1;

        if ($plaza->estado_inicial == 'Disponible'){
            $disponibilidad->plazas_libres = $disponibilidad->plazas_libres - 1;
        }

        if ($plaza->estado_inicial == 'No disponible'){
            $disponibilidad->plazas_ocupadas = $disponibilidad->plazas_ocupadas - 1;
        }

        $disponibilidad->plaza_id = 1;

        $disponibilidad->save();

    }


    public function plaza(){
        return $this->belongsTo(Plaza::class);
    }

}
