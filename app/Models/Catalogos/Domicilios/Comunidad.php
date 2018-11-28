<?php

namespace App\Models\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\ComunidadFilter;
use App\Traits\Catalogos\Domicilio\Comunidad\ComunidadTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunidad extends Model
{

    use SoftDeletes;
    use ComunidadTrait;

    protected $guard_name = 'web';
    protected $table = 'comunidades';

    protected $fillable = [
        'id', 'comunidad','delegado_id','tipocomunidad_id',
    ];

    public function scopeFilterBy($query, $filters){
        return (new ComunidadFilter())->applyTo($query, $filters);
    }

    public function delegado() {
        return $this->hasOne(User::class,'id','delegado_id');
    }

    public function tipoComunidad() {
        return $this->hasOne(Tipocomunidad::class,'id','tipocomunidad_id');
    }




}
