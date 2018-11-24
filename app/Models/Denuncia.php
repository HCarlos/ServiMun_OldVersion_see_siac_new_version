<?php

namespace App\Models;

use App\Models\Catalogos\Origen;
use App\Models\Catalogos\Prioridad;
use App\Models\Catalogos\Servicio;
use App\Models\Catalogos\Ubicacion;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denuncia extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'denuncias';

    protected $fillable = [
        'id', 'fecha_ingreso','cantidad','descripcion','referencia',
        'oficio_envio','fecha_oficio_dependencia','fecha_limite','fecha_ejecucion',
        'prioridad_id','origen_id','dependecia_id','ubicacion_id','servicio_id',
        'ciudadano_id','user_id','status_denuncia','empresa_id','ip','host',
    ];

    public function prioridad(){
        return $this->hasOne(Prioridad::class,'prioridad_id');
    }

    public function origen(){
        return $this->hasOne(Origen::class,'origen_id');
    }

    public function prioridades(){
        return $this->belongsToMany(Prioridad::class,'prioridades','prioridad_id');
    }

    public function origenes(){
        return $this->belongsToMany(Origen::class,'origenes','origen_id');
    }

    public function dependencias(){
        return $this->belongsToMany(Dependencia::class,'dependencias','dependencia_id');
    }

    public function ubicaciones(){
        return $this->belongsToMany(Ubicacion::class,'ubicaciones','ubicacion_id');
    }

    public function servicios(){
        return $this->belongsToMany(Servicio::class,'servicios','servicio_id');
    }

    public function ciudadanos(){
        return $this->belongsToMany(User::class,'users','ciudadano_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'users','user_id');
    }


}
