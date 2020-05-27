<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Empleado;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => 'daregu',
        'email_verified_at' => now(),
        'password' => '$2y$12$csL2OKEXYmnKH0iPu04Gs./sgfhtez0hJTYiqZPMpTULngkPIOP6i', // password
        'empleado_id' =>Empleado::all()->random()->id,
        'remember_token' => Str::random(10),
    ];
});
