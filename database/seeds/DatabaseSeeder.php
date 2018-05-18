<?php

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
        DB::table('plazas_reporte')->truncate();

        User::flushEventListeners();
        Plaza::flushEventListeners();
        Ocupacion::flushEventListeners();
        Nodemcu::flushEventListeners();
        Tipo::flushEventListeners();
        Reporte::flushEventListeners();
        Estacionamiento::flushEventListeners();

        factory(User::class, 1)->create();
        factory(Estacionamiento::class, 1)->create();
        //factory(Nodemcu::class, 2)->create();

        $node1 = new Nodemcu();
        $node1->nodemcu_clave = "AAAA";
        $node1->save();

        $node2 = new Nodemcu();
        $node2->nodemcu_clave = "BBBB";
        $node2->save();

        factory(Tipo::class, 3)->create();
        factory(Plaza::class, 20)->create();
        factory(\App\Disponibilidad::class,1)->create();
    }
}
