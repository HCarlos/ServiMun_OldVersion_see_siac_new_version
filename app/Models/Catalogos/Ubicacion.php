<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'ubicaciones';

    protected $fillable = [
        'id', 'calle','num_ext','num_int','colonia', 'localidad','municipio','estado','pais', 'cp','latitud','longitud',
    ];

}
