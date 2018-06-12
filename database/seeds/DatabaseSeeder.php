<?php

use App\Disponibilidad;
use App\Estacionamiento;
use App\Nodemcu;
use App\Ocupacion;
use App\Plaza;
use App\Reporte;
use App\Tipo;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Plaza::truncate();
        Ocupacion::truncate();
        Nodemcu::truncate();
        Tipo::truncate();
        Estacionamiento::truncate();
        Reporte::truncate();
        //DB::table('plazas_reporte')->truncate();

        User::flushEventListeners();
        Plaza::flushEventListeners();
        Ocupacion::flushEventListeners();
        Nodemcu::flushEventListeners();
        Tipo::flushEventListeners();
        Reporte::flushEventListeners();
        Estacionamiento::flushEventListeners();

        factory(User::class, 2)->create();
        factory(Estacionamiento::class, 1)->create();
        //factory(Nodemcu::class, 2)->create();

        $node1 = new Nodemcu();
        $node1->nodemcu_clave = "AAAA";
        $node1->save();

        $node2 = new Nodemcu();
        $node2->nodemcu_clave = "BBBB";
        $node2->save();

        $tipo = new Tipo();
        $tipo->nombre = "Uso General";
        $tipo->descripcion = "Plaza de uso general.";
        $tipo->save();

        $tipo2 = new Tipo();
        $tipo2->nombre = "Discapacitados";
        $tipo2->descripcion = "Plaza reservada para discapacitados.";
        $tipo2->save();

        $tipo3 = new Tipo();
        $tipo3->nombre = "Embarazadas";
        $tipo3->descripcion = "Plaza reservada para embarazadas.";
        $tipo3->save();

        $user1 = new User();
        $user1->name = "Master User";
        $user1->email = "admin@admin.com";
        $user1->password = bcrypt('123123');
        $user1->admin = 1;
        $user1->estacionamiento_id = 1;
        $user1->save();

        $reporte1 = new Reporte();
        $reporte1->nombre_reporte = "Fiestas Patrias 2017";
        $reporte1->descripcion_reporte = "Ocupación de la plaza 1 durante el 17 y 19 de septiembre de 2017";
        $reporte1->fechainicio = "17-09-2017";
        $reporte1->fechafin = "19-09-2017";
        $reporte1->plaza_id = 1;
        $reporte1->save();

        $reporte2 = new Reporte();
        $reporte2->nombre_reporte = "Navidad 2017";
        $reporte2->descripcion_reporte = "Ocupación de la plaza 1 durante el 17 y 19 de septiembre de 2017";
        $reporte2->fechainicio = "20-12-2017";
        $reporte2->fechafin = "27-12-2017";
        $reporte2->plaza_id = 2;
        $reporte2->save();

        factory(Plaza::class, 2)->create();
        factory(Disponibilidad::class,1)->create();
    }
}
