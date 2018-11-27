<?php

namespace App\Models\Catalogos;

use App\Filters\Catalogo\AfiliacionFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Afiliacion extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'afiliaciones';

    protected $fillable = [
        'id', 'afiliacion',
    ];

    public function scopeFilterBy($query, $filters){
        return (new AfiliacionFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($afiliacion){
        $obj = static::where('afiliacion', $afiliacion)->first();
        if (!$obj) {
            $obj = static::create([
                'afiliacion' => strtoupper($afiliacion),
            ]);
        }
        return $obj;
    }
    
    
}
