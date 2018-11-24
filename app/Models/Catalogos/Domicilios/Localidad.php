<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidad extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'localidades';

    protected $fillable = [
        'id', 'localidad',
    ];

    public static function findOrImport($localidad){
        $obj = static::where('localidad', $localidad)->first();
        if (!$obj) {
            $obj = static::create([
                'localidad' => strtoupper($localidad),
            ]);
        }
        return $obj;
    }
    

}
