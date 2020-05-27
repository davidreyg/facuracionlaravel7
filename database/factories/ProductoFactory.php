<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Categoria;
use App\Models\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->company,
        'descripcion' => $faker->sentence(6, true),
        'stock' => $faker->randomNumber(3),
        'precio_compra' => $faker->numberBetween(500,100000),
        'precio_venta' => $faker->numberBetween(0,50000),
        'ganancia' => $faker->numberBetween(0, 50000),
        'moneda' => 'PEN',
        'categoria_id' => Categoria::all()->random()->id
    ];
});
