<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medida extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'medidas';

    protected $fillable = [
        'id', 'medida',
    ];

    public static function findOrImport($medida){
        $obj = static::where('medida', $medida)->first();
        if (!$obj) {
            $obj = static::create([
                'medida' => strtoupper($medida),
            ]);
        }
        return $obj;
    }



}
