<?php

namespace App\Models\Catalogos;

use App\Filters\Catalogo\EstatuFilter;
use App\Models\Denuncias\Denuncia;
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

    protected $casts = ['predeterminado'=>'boolean',];

    public function isDefault(){
        return $this->predeterminado;
    }

    public function scopeFilterBy($query, $filters){
        return (new EstatuFilter())->applyTo($query, $filters);
    }

    public function dependencias(){
        return $this->belongsToMany(Dependencia::class);
    }

    public function denuncias(){
        return $this->belongsToMany(Denuncia::class,'denuncia_dependencia_servicio_estatus','estatu_id','denuncia_id');
    }

    public function denuncia_dependencias(){
        return $this->belongsToMany(Dependencia::class,'denuncia_dependencia_servicio_estatus','estatu_id','dependencia_id');
    }

    public function servicios(){
        return $this->belongsToMany(Servicio::class,'denuncia_dependencia_servicio_estatus','estatu_id','servicio_id');
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
