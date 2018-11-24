<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prioridad extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'prioridades';

    protected $fillable = [
        'id', 'prioridad','predeterminado', 'class_css',
    ];

    protected $casts = ['predeterminado'=>'boolean',];

    public function isDefault(){
        return $this->predeterminado;
    }

    public static function findOrImport($prioridad,$predeterminado,$class_css){
        $obj = static::where('prioridad', $prioridad)->first();
        if (!$obj) {
            $obj = static::create([
                'prioridad' => strtoupper($prioridad),
                'predeterminado' => $predeterminado,
                'class_css' => $class_css,
            ]);
        }
        return $obj;
    }




}
