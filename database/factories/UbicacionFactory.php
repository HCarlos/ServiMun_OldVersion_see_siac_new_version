<?php

use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Comunidad;
use App\Models\Catalogos\Domicilios\Ubicacion;
use Faker\Generator as Faker;

$factory->define(Ubicacion::class, function (Faker $faker) {

    $IdCalle     = $faker->numberBetween(1, Calle::all()->count());
    $IdColonia   = $faker->numberBetween(1, Colonia::all()->count());

    $Calle       = Calle::find($IdCalle);
    $Colonia     = Colonia::find($IdColonia);
    $Localidad   = Comunidad::find($Colonia->comunidad_id);
    $CPs         = Codigopostal::find($Colonia->codigopostal_id);

    return [
        'calle' => strtoupper($Calle->calle),
        'num_ext' => str_random(10),
        'colonia' => strtoupper($Colonia->colonia),
        'localidad' => strtoupper($Localidad->comunidad),
        'ciudad' => strtoupper($Localidad->ciudad->ciudad),
        'municipio' => strtoupper($Localidad->municipio->municipio),
        'estado' => strtoupper($Localidad->estado->estado),
        'cp' => $CPs->cp,
        'latitud' => $faker->latitude,
        'longitud' => $faker->longitude,
        'calle_id' => $IdCalle,
        'colonia_id' => $IdColonia,
        'localidad_id' => $Localidad->id,
        'ciudad_id' => $Localidad->ciudad_id,
        'municipio_id' => $Localidad->municipio_id,
        'estado_id' => $Localidad->estado_id,
        'codigopostal_id' => $CPs->id,
    ];

});
