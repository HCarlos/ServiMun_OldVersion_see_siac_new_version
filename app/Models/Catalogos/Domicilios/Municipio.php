<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'municipios';

    protected $fillable = [
        'id', 'municipio',
    ];

    public static function findOrImport($municipio){
        $obj = static::where('municipio', $municipio)->first();
        if (!$obj) {
            $obj = static::create([
                'municipio' => strtoupper($municipio),
            ]);
        }
        return $obj;
    }


}
