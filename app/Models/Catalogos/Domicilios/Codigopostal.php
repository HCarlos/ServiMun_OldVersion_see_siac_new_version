<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Codigopostal extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'codigospostales';

    protected $fillable = [
        'id', 'codigo', 'cp',
    ];

    public static function findOrImport($codigo,$cp){
        $obj = static::where('codigo', $codigo)->first();
        if (!$obj) {
            $obj = static::create([
                'codigo' => strtoupper($codigo),
                'cp' => strtoupper($cp),
            ]);
        }
        return $obj;
    }



}
