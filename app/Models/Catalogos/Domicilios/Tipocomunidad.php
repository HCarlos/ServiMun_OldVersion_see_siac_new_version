<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipocomunidad extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'tipocomunidades';

    protected $fillable = [
        'id', 'tipocomunidad',
    ];

    public static function findOrImport($tipocomunidad){
        $obj = static::where('tipocomunidad', $tipocomunidad)->first();
        if (!$obj) {
            $obj = static::create([
                'tipocomunidad' => strtoupper($tipocomunidad),
            ]);
        }
        return $obj;
    }
    
    
}
