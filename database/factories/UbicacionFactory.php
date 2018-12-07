<?php

use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Comunidad;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Models\Catalogos\Domicilios\Ubicacion;
use Faker\Generator as Faker;

$factory->define(Ubicacion::class, function (Faker $faker) {
    $IdCalle     = $faker->numberBetween(1, Calle::all()->count());
    $IdColonia   = $faker->numberBetween(1, Colonia::all()->count());
    $IdCiudad    = $faker->numberBetween(1, Ciudad::all()->count());
    $IdMunicipio = $faker->numberBetween(1, Municipio::all()->count());
    $IdEstado    = $faker->numberBetween(1, Estado::all()->count());

    $Calle       = Calle::find($IdCalle);
    $Colonia     = Colonia::find($IdColonia);
    $Localidad   = Comunidad::find($Colonia->comunidad_id);
    $Ciudad      = Ciudad::find($IdCiudad);
    $Municipio   = Municipio::find($IdMunicipio);
    $Estado      = Estado::find($IdEstado);
    $CPs         = Codigopostal::find($Colonia->codigopostal_id);
    return [
        'calle' => strtoupper($Calle->calle),
        'num_ext' => str_random(10),
        'colonia' => strtoupper($Colonia->colonia),
        'localidad' => strtoupper($Localidad->comunidad),
        'ciudad' => strtoupper($Ciudad->ciudad),
        'municipio' => strtoupper($Municipio->municipio),
        'estado' => strtoupper($Estado->estado),
        'cp' => $CPs->cp,
        'latitud' => $faker->latitude,
        'longitud' => $faker->longitude,
        'calle_id' => $IdCalle,
        'colonia_id' => $IdColonia,
        'localidad_id' => $Localidad->id,
        'ciudad_id' => $IdCiudad,
        'municipio_id' => $IdMunicipio,
        'estado_id' => $IdEstado,
        'codigopostal_id' => $CPs->id,
    ];
/*
    $Ubi->calles()->attach($IdCalle);
    $Ubi->colonias()->attach($IdColonia);
    $Ubi->localidades()->attach($Localidad->id);
    $Ubi->ciudades()->attach($IdCiudad);
    $Ubi->municipios()->attach($IdMunicipio);
    $Ubi->estados()->attach($IdEstado);
    $Ubi->codigospostales()->attach($$CPs->id);
*/

});
