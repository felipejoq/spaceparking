<?php

use App\Disponibilidad;
use App\Estacionamiento;
use App\Nodemcu;
use App\Ocupacion;
use App\Plaza;
use App\Reporte;
use App\Tipo;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        User::truncate();
        Plaza::truncate();
        Ocupacion::truncate();
        Nodemcu::truncate();
        Tipo::truncate();
        Estacionamiento::truncate();
        Reporte::truncate();
        Role::truncate();
        Permission::truncate();
        //DB::table('plazas_reporte')->truncate();

        User::flushEventListeners();
        Plaza::flushEventListeners();
        Ocupacion::flushEventListeners();
        Nodemcu::flushEventListeners();
        Tipo::flushEventListeners();
        Reporte::flushEventListeners();
        Estacionamiento::flushEventListeners();
        Permission::flushEventListeners();
        Role::flushEventListeners();

        $administradorRol = Role::create(['name' => 'Administrador']);
        $trabajadorRol = Role::create(['name' => 'Trabajador']);

        $superPermiso = Permission::create(['name' => 'Super Administrador']);

        $administradorRol->givePermissionTo($superPermiso);

        factory(Estacionamiento::class, 1)->create();

        $user1 = new User();
        $user1->name = "Administrador User";
        $user1->email = "admin@admin.cl";
        $user1->password = bcrypt('123123');
        $user1->estacionamiento_id = 1;
        $user1->save();
        $user1->assignRole($administradorRol);

        $user2 = new User();
        $user2->name = "Trabajador User";
        $user2->email = "trabajador@admin.cl";
        $user2->password = bcrypt('123123');
        $user2->estacionamiento_id = 1;
        $user2->save();
        $user2->assignRole($trabajadorRol);

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

        $reporte1 = new Reporte();
        $reporte1->nombre_reporte = "Fiestas Patrias 2017";
        $reporte1->descripcion_reporte = "Ocupación de la plaza 1 durante el día de la madre 2018.";
        $reporte1->fechainicio = "13-05-2018";
        $reporte1->fechafin = "13-05-2018";
        $reporte1->plaza_id = 1;
        $reporte1->save();

        $plaza1 = new Plaza();
        $plaza1->numero_plaza = "001";
        $plaza1->descripcion = "Plaza 001 para pruebas.";
        $plaza1->estado_inicial = "Disponible";
        $plaza1->quien_edita = 0;
        $plaza1->tipo_id = 1;
        $plaza1->nodemcu_id = 1;
        $plaza1->save();

        $plaza2 = new Plaza();
        $plaza2->numero_plaza = "002";
        $plaza2->descripcion = "Plaza 002 para pruebas.";
        $plaza2->estado_inicial = "Disponible";
        $plaza2->quien_edita = 0;
        $plaza2->tipo_id = 1;
        $plaza2->nodemcu_id = 1;
        $plaza2->save();

        $plaza3 = new Plaza([
            'numero_plaza' => "003",
            'descripcion' => "Plaza 003 para pruebas.",
            'estado_inicial' => "Disponible",
            'quien_edita' => 0,
            'tipo_id' => 1,
            'nodemcu_id' => 2,
        ]);
        $plaza3->save();

        $plaza4 = new Plaza([
            'numero_plaza' => "004",
            'descripcion' => "Plaza 004 para pruebas.",
            'estado_inicial' => "Disponible",
            'quien_edita' => 0,
            'tipo_id' => 1,
            'nodemcu_id' => 2,
        ]);
        $plaza4->save();

        //factory(Plaza::class, 2)->create();
        factory(Disponibilidad::class,1)->create();

        factory(Ocupacion::class, 5000)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
