<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asentamiento extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'asentamientos';

    protected $fillable = [
        'id', 'asentamiento',
    ];

    public static function findOrImport($asentamiento){
        $obj = static::where('asentamiento', $asentamiento)->first();
        if (!$obj) {
            $obj = static::create([
                'asentamiento' => strtoupper($asentamiento),
            ]);
        }
        return $obj;
    }
    
    
}
