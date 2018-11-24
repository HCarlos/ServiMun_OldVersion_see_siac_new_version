<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'areas';

    protected $fillable = [
        'id',
        'area', 'dependencia_id','jefe_id',
    ];

    public function Dependencia() {
        return $this->hasMany(Dependencia::class,'dependencia_id');
    }

    public static function findOrImport($area,$dependencia_id,$jefe_id){
        $obj = static::where('area', $area)->first();
        if (!$obj) {
            $obj = static::create([
                'area' => strtoupper($area),
                'dependencia_id' => $dependencia_id,
                'jefe_id' => $jefe_id,
            ]);
        }
        return $obj;
    }


}
