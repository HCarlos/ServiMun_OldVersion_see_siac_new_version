<?php

namespace App\Models\Catalogos;

use App\Filters\Catalogo\Dependencia\AreaFilter;
use App\User;
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

    public function scopeFilterBy($query, $filters){
        return (new AreaFilter())->applyTo($query, $filters);
    }

    public function jefe() {
        return $this->belongsTo(User::class,'jefe_id','id');
    }

    public function dependencia() {
        return $this->hasOne(Dependencia::class,'id','dependencia_id');
    }

    public static function findOrImport($area,$dependencia_id,$jefe_id){
        $obj = static::where('area', trim($area))->first();
        if (!$obj) {
            $obj = static::create([
                'area' => strtoupper(trim($area)),
                'dependencia_id' => $dependencia_id,
                'jefe_id' => $jefe_id,
            ]);
        }
        return $obj;
    }


}
