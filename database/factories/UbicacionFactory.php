<?php

use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Localidad;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Models\Catalogos\Domicilios\Ubicacion;
use Faker\Generator as Faker;

$factory->define(Ubicacion::class, function (Faker $faker) {
    $IdCalle     = $faker->numberBetween(1, Calle::all()->count());
    $IdColonia   = $faker->numberBetween(1, Colonia::all()->count());
    $IdLocalidad = $faker->numberBetween(1, Localidad::all()->count());
    $IdCiudad    = $faker->numberBetween(1, Ciudad::all()->count());
    $IdMunicipio = $faker->numberBetween(1, Municipio::all()->count());
    $IdEstado    = $faker->numberBetween(1, Estado::all()->count());
    $IdCPs       = $faker->numberBetween(1, Codigopostal::all()->count());

    $Calle       = Calle::find($IdCalle);
    $Colonia     = Colonia::find($IdColonia);
    $Localidad   = Localidad::find($IdLocalidad);
    $Ciudad      = Ciudad::find($IdCiudad);
    $Municipio   = Municipio::find($IdMunicipio);
    $Estado      = Estado::find($IdEstado);
    $CPs         = Codigopostal::find($IdCPs);
    return [
        'calle' => strtoupper($Calle->calle),
        'num_ext' => str_random(10),
        'colonia' => strtoupper($Colonia->colonia),
        'localidad' => strtoupper($Localidad->localidad),
        'ciudad' => strtoupper($Ciudad->ciudad),
        'municipio' => strtoupper($Municipio->municipio),
        'estado' => strtoupper($Estado->estado),
        'cp' => $CPs->cp,
        'latitud' => $faker->latitude,
        'longitud' => $faker->longitude,
        'calle_id' => $IdCalle,
        'colonia_id' => $IdColonia,
        'localidad_id' => $IdLocalidad,
        'ciudad_id' => $IdCiudad,
        'municipio_id' => $IdMunicipio,
        'estado_id' => $IdEstado,
        'codigopostal_id' => $IdCPs,
    ];
});
