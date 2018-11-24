<?php

namespace App\Models\Catalogos\Domicilios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'estados';

    protected $fillable = [
        'id', 'estado',
    ];

    public static function findOrImport($estado){
        $obj = static::where('estado', $estado)->first();
        if (!$obj) {
            $obj = static::create([
                'estado' => strtoupper($estado),
            ]);
        }
        return $obj;
    }



}