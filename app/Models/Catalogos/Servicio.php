<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'servicios';

    protected $fillable = [
        'id', 'servicio','habilitado', 'medida_id', 'subarea_id',
    ];

    protected $casts = ['habilitado'=>'boolean',];

    public function isEnabled(){
        return $this->habilitado;
    }

    public function Medida() {
        return $this->hasMany(Medida::class,'medida_id');
    }

    public function Subarea() {
        return $this->hasMany(Subarea::class,'subarea_id');
    }

    public static function findOrImport($servicio,$habilitado,$medida_id,$subarea_id){
        $obj = static::where('servicio', $servicio)->first();
        if (!$obj) {
            $obj = static::create([
                'servicio' => strtoupper($servicio),
                'habilitado' => $habilitado,
                'medida_id' => $medida_id,
                'subarea_id' => $subarea_id,
            ]);
        }
        return $obj;
    }
    
    
    
}
