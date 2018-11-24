<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calle extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'calles';

    protected $fillable = [
        'id', 'calle',
    ];

    public static function findOrImport($calle){
        $obj = static::where('calle', $calle)->first();
        if (!$obj) {
            $obj = static::create([
                'calle' => strtoupper($calle),
            ]);
        }
        return $obj;
    }



}
