<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'ciudades';

    protected $fillable = [
        'id', 'ciudad',
    ];

    public static function findOrImport($ciudad){
        $obj = static::where('ciudad', $ciudad)->first();
        if (!$obj) {
            $obj = static::create([
                'ciudad' => strtoupper($ciudad),
            ]);
        }
        return $obj;
    }


}
