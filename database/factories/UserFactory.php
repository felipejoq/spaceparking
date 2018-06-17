<?php

use App\Disponibilidad;
use App\Estacionamiento;
use App\Nodemcu;
use App\Plaza;
use App\Tipo;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Estacionamiento::class, function (Faker $faker) {
    return array(
        'nombre' => 'Estacionamiento Público',
        'direccion' => '18 de Septiembre, #575. Chillán.',
        'telefono' => '(+56) 42 2 334 4554',
    );
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt("123123"), // secret
        'estacionamiento_id' => 1,
        'remember_token' => str_random(10),
    ];
});

$factory->define(Tipo::class, function (Faker $faker) {
    return array(
        'nombre' => $faker->sentence(1),
        'descripcion' => $faker->paragraph(1),
    );
});

$factory->define(Nodemcu::class, function (Faker $faker) {
    return array(
        'nodemcu_clave' => $faker->unique()->randomElement(['AAAA', 'BBBB']),
    );
});


$factory->define(Plaza::class, function (Faker $faker) {
    return array(
        'numero_plaza' => $faker->numerify('###'),
        'descripcion' => $faker->sentence(3),
        'estado_inicial' => 'Disponible',
        'tipo_id' => 1,
        'nodemcu_id' => 1,
    );
});

$factory->define(Disponibilidad::class, function (Faker $faker) {
    return array(
        'total_plazas' => Plaza::count(),
        'plazas_libres' => Plaza::count(),
        'plazas_ocupadas' => 0,
        'plaza_id' => $faker->numberBetween(1, Plaza::count()),
    );
});

