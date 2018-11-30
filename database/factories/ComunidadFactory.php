<?php

use App\Models\Catalogos\Domicilios\Comunidad;
use App\Models\Catalogos\Domicilios\Tipocomunidad;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comunidad::class, function (Faker $faker) {
    return [
        'comunidad' => strtoupper($faker->sentence()),
        'delegado_id' => $faker->unique()->numberBetween(1, User::all()->count()),
        'tipocomunidad_id' => $faker->numberBetween(1, Tipocomunidad::all()->count()),
    ];
});
