<?php

use App\User;
use Faker\Generator as Faker;


$factory->define(User::class, function (Faker $faker) {
    return [
        'ap_paterno' => strtoupper($faker->lastName),
        'ap_materno' => strtoupper($faker->lastName),
        'nombre' => strtoupper($faker->firstName),
        'username' => $faker->unique()->userName,
        'genero' => $faker->numberBetween(0,1),
        'fecha_nacimiento' => $faker->date(),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
