<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatu extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'estatus';

    protected $fillable = [
        'id', 'estatus',
    ];

    public function dependencias(){
        return $this->belongsToMany(Dependencia::class,'dependencias','dependencia_id');
    }

    public static function findOrImport($estatus){
        $obj = static::where('estatus', $estatus)->first();
        if (!$obj) {
            $obj = static::create([
                'estatus' => strtoupper($estatus),
            ]);
        }
        return $obj;
    }


}
