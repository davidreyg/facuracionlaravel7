<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Empleado;
use Faker\Generator as Faker;
use App\Models\TipoDocumento;
use Faker\Provider\es_PE\Person;

$factory->define(Empleado::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));;
    return [
        'nombres' => $faker->firstName,
        'apellidos' => $faker->lastName,
        'correo' => $faker->unique()->safeEmail,
        'telefono' => $faker->randomNumber($nbDigits = 9),
        'direccion' => $faker->address,
        'numero_documento' => $faker->dni,
        'tipo_documento_id' =>TipoDocumento::all()->random()->id
    ];
});
