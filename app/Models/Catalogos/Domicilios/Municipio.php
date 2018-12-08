<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\MunicipioFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'municipios';

    protected $fillable = [
        'id', 'municipio',
    ];

    public function scopeFilterBy($query, $filters){
        return (new MunicipioFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($municipio){
        $obj = static::where('municipio', trim($municipio))->first();
        if (!$obj) {
            $obj = static::create([
                'municipio' => strtoupper(trim($municipio)),
            ]);
        }
        return $obj;
    }


}
