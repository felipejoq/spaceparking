<?php

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
        'nombre' => $faker->name,
        'direccion' => $faker->paragraph(3),
        'telefono' => $faker->phoneNumber,
    );
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt("123123"), // secret
        'admin' => 1,
        'estacionamiento_id' => 1,
        'remember_token' => str_random(10),
    ];
});

$factory->define(Tipo::class, function (Faker $faker) {
    return array(
        'nombre' => $faker->name,
        'descripcion' => $faker->paragraph(3),
    );
});

$factory->define(Nodemcu::class, function (Faker $faker) {
    return array(
        'nodemcu_clave' => 'AAAA',
    );
});

$factory->define(Plaza::class, function (Faker $faker) {
    return array(
        'numero_plaza' => $faker->numerify('###'),
        'descripcion' => $faker->paragraph(1),
        'tipo_id' => $faker->numberBetween(1,2),
    );
});


