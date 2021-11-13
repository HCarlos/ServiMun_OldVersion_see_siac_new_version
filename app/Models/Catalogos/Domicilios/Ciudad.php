<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\CiudadFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'ciudades';

    protected $fillable = [
        'id', 'ciudad', 'ciudad_mig_id', 'municipio_id',
    ];

    public function scopeFilterBy($query, $filters){
        return (new CiudadFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($ciudad){
        $obj = static::where('ciudad', trim($ciudad))->first();
        if (!$obj) {
            $obj = static::create([
                'ciudad' => strtoupper(trim($ciudad)),
            ]);
        }
        return $obj;
    }


}
