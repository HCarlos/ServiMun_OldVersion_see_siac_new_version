<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subarea extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'subareas';

    protected $fillable = [
        'id', 'subarea','area_id','jefe_id',
    ];

    public function Area() {
        return $this->hasMany(Area::class,'area_id');
    }

    public function Jefe() {
        return $this->hasMany(User::class,'jefe_id');
    }

    public static function findOrImport($subarea,$area_id,$jefe_id){
        $obj = static::where('subarea', $subarea)->first();
        if (!$obj) {
            $obj = static::create([
                'subarea' => strtoupper($subarea),
                'area_id' => $area_id,
                'jefe_id' => $jefe_id,
            ]);
        }
        return $obj;
    }


}
