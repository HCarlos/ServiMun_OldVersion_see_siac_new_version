<?php

namespace App\Models;

use App\Filters\Denuncia\DenunciaFilter;
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
        'id','cantidad',
        'fecha_ingreso','oficio_envio','fecha_oficio_dependencia','fecha_limite','fecha_ejecucion',
        'descripcion','referencia',
        'calle','num_ext','num_int','colonia', 'localidad','ciudad','municipio','estado','pais', 'cp',
        'latitud','longitud',
        'prioridad_id','origen_id','dependecia_id','ubicacion_id','servicio_id',
        'ciudadano_id','creadopor_id','modificadopor_id',
        'searchtextdenuncia',
    ];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtextdenuncia @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtextdenuncia, to_tsquery('spanish', ?)) DESC", [$search]);
    }

    public function scopeFilterBy($query, $filters){
        return (new DenunciaFilter())->applyTo($query, $filters);
    }

    public function prioridad(){
        return $this->hasOne(Prioridad::class,'id','prioridad_id');
    }
    public function prioridades(){
        return $this->belongsToMany(Prioridad::class,'denuncia_prioridad','denuncia_id','prioridad_id');
    }

    public function origen(){
        return $this->hasOne(Origen::class,'id','origen_id');
    }
    public function origenes(){
        return $this->belongsToMany(Origen::class,'denuncia_origen','denuncia_id','origen_id');
    }

    public function dependencia(){
        return $this->hasOne(Dependencia::class,'id','dependencia_id');
    }
    public function dependencias(){
        return $this->belongsToMany(Dependencia::class,'denuncia_dependencia','denuncia_id','dependencia_id');
    }

    public function ubicacion(){
        return $this->hasOne(Ubicacion::class,'id','ubicacion_id');
    }
    public function ubicaciones(){
        return $this->belongsToMany(Ubicacion::class,'denuncia_ubicacion','denuncia_id','ubicacion_id');
    }

    public function servicio(){
        return $this->hasOne(Servicio::class,'id','servicio_id');
    }
    public function servicios(){
        return $this->belongsToMany(Servicio::class,'denuncia_servicio','denuncia_id','servicio_id');
    }

    public function ciudadano(){
        return $this->hasOne(User::class,'id','ciudadano_id');
    }
    public function ciudadanos(){
        return $this->belongsToMany(User::class,'ciudadano_denuncia','denuncia_id','ciudadano_id');
    }

    public function creadopor(){
        return $this->hasOne(User::class,'id','creadopor_id');
    }
    public function creadospor(){
        return $this->belongsToMany(User::class,'creadopor_denuncia','denuncia_id','creadopor_id');
    }

    public function modificadopor(){
        return $this->hasOne(User::class,'id','modificadopor_id');
    }
    public function modificadospor(){
        return $this->belongsToMany(User::class,'denuncia_modificadopor','denuncia_id','modificadopor_id');
    }


}
