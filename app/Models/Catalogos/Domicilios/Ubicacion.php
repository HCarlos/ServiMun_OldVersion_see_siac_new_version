<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\UbicacionFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'ubicaciones';

    protected $fillable = [
        'id', 'calle','num_ext','num_int','colonia', 'localidad','ciudad','municipio','estado','pais', 'cp',
        'latitud','longitud','searchtext',
        'calle_id', 'colonia_id','localidad_id','ciudad_id', 'municipio_id','estado_id', 'codigopostal_id',
    ];

    public function scopeFilterBy($query,$filerts){
        return (new UbicacionFilter())->applyTo($query, $filerts);
    }

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) DESC", [$search]);
    }

    public function calle() {
        return $this->hasOne(Calle::class,'id','calle_id');
    }
    public function calles(){
        return $this->belongsToMany(Calle::class,'calle_ubicacion','ubicacion_id','calle_id');
    }

    public function colonia() {
        return $this->hasOne(Colonia::class,'id','colonia_id');
    }
    public function colonias(){
        return $this->belongsToMany(Colonia::class,'colonia_ubicacion','ubicacion_id','colonia_id');
    }

    public function localidad() {
        return $this->hasOne(Localidad::class,'id','localidad_id');
    }
    public function localidades(){
        return $this->belongsToMany(Localidad::class,'localidad_ubicacion','ubicacion_id','localidad_id');
    }

    public function ciudad() {
        return $this->hasOne(Ciudad::class,'id','ciudad_id');
    }
    public function ciudades(){
        return $this->belongsToMany(Ciudad::class,'ciudad_ubicacion','ubicacion_id','ciudad_id');
    }

    public function municipio() {
        return $this->hasOne(Municipio::class,'id','municipio_id');
    }
    public function municipios(){
        return $this->belongsToMany(Municipio::class,'municipio_ubicacion','ubicacion_id','municipio_id');
    }

    public function estado() {
        return $this->hasOne(Estado::class,'id','estado_id');
    }
    public function estados(){
        return $this->belongsToMany(Estado::class,'estado_ubicacion','ubicacion_id','estado_id');
    }

    public function codigopostal() {
        return $this->hasOne(Codigopostal::class,'id','codigopostal_id');
    }
    public function codigospostales(){
        return $this->belongsToMany(Codigopostal::class,'codigopostal_ubicacion','ubicacion_id','codigopostal_id');
    }

}
