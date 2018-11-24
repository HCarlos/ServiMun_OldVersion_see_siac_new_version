<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipoasentamiento extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'tipoasentamientos';

    protected $fillable = [
        'id', 'tipoasentamiento',
    ];

    public static function findOrImport($tipoasentamiento){
        $obj = static::where('tipoasentamiento', $tipoasentamiento)->first();
        if (!$obj) {
            $obj = static::create([
                'tipoasentamiento' => strtoupper($tipoasentamiento),
            ]);
        }
        return $obj;
    }
    
    
}
