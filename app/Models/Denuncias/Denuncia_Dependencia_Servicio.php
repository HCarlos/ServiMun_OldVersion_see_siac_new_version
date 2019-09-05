<?php

namespace App\Models\Denuncias;

use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Estatu;
use App\Models\Catalogos\Servicio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denuncia_Dependencia_Servicio extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'denuncia_dependencia_servicio_estatus';

    protected $fillable = [
        'id',
        'denuncia_id','dependencia_id','servicio_id','estatu_id','fecha_movimiento','observaciones',
    ];

    public function denuncia(){
        return $this->hasOne(Denuncia::class,'id','denuncia_id');
    }

    public function estatu(){
        return $this->hasOne(Estatu::class,'id','estatu_id');
    }

    public function dependencia(){
        return $this->hasOne(Dependencia::class,'id','dependencia_id');
    }

    public function servicio(){
        return $this->hasOne(Servicio::class,'id','servicio_id');
    }


}
