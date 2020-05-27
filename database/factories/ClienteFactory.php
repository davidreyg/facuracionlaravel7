<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cliente;
use App\Models\TipoDocumento;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nombres' => $faker->firstName,
        'apellidos' => $faker->lastName,
        'correo' => $faker->unique()->safeEmail,
        'telefono' => $faker->randomNumber($nbDigits = 9),
        'direccion' => $faker->address,
        'numero_documento' => $faker->dni,
        'tipo_documento_id' => TipoDocumento::all()->random()->id
    ];
});
