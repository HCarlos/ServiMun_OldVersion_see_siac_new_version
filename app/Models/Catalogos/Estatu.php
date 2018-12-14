<?php

namespace App\Models\Catalogos;

use App\Filters\Catalogo\EstatuFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatu extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'estatus';

    protected $fillable = [
        'id', 'estatus','predeterminado',
    ];

    public function isDefault(){
        return $this->predeterminado;
    }

    protected $casts = ['predeterminado'=>'boolean',];

    public function scopeFilterBy($query, $filters){
        return (new EstatuFilter())->applyTo($query, $filters);
    }

    public function dependencias(){
        return $this->belongsToMany(Dependencia::class);
    }

    public static function findOrImport($estatus){
        $obj = static::where('estatus', trim($estatus))->first();
        if (!$obj) {
            $obj = static::create([
                'estatus' => strtoupper(trim($estatus)),
            ]);
        }
        return $obj;
    }


}
