<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colonia extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'colonias';

    protected $fillable = [
        'id', 'colonia', 'cp','altitud','latitud','longitud','codigospostal_id','comunidad_id','tipocomunidad_id',
    ];

    public function CodigoPostal() {
        return $this->hasOne(Codigopostal::class,'codigospostal_id');
    }

    public function Comunidad() {
        return $this->hasOne(Comunidad::class,'comunidad_id');
    }

    public function TipoComunidad() {
        return $this->hasOne(Tipocomunidad::class,'tipocomunidad_id');
    }

    public static function findOrImport($colonia,$cp,$altitud,$latitud,$longitud,$codigospostal_id,$comunidad_id,$tipocomunidad_id){
        $obj = static::where('colonia', $colonia)->first();
        if (!$obj) {
            $obj = static::create([
                'colonia' => strtoupper($colonia),
                'cp' => strtoupper($cp),
                'altitud' => $altitud,
                'latitud' => $latitud,
                'longitud' => $longitud,
                'codigospostal_id' => $codigospostal_id,
                'comunidad_id' => $comunidad_id,
                'tipocomunidad_id' => $tipocomunidad_id,
            ]);
        }
        return $obj;
    }



}
