<?php

namespace App\Models\Mobiles;

use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Origen;
use App\Traits\Denuncia\DenunciaTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denunciamobile extends Model{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'denunciamobile';


    protected $fillable = [
        'id',
        'denuncia',
        'fecha',
        'tipo_mobile',
        'marca_mobile',
        'serviciomobile_id',
        'ubicacion_id',
        'ubicacion',
        'ubicacion_google',
        'latitud',
        'longitud',
        'altitud',
        'user_id',
    ];

    //    protected $hidden = ['deleted_at','created_at','updated_at'];
    protected $dates = ['fecha' => 'datetime:d-m-Y'];
//    protected $casts = ['cerrado'=>'boolean','firmado'=>'boolean','favorable'=>'boolean',];

    public function Servicio(){
        return $this->hasOne(Serviciomobile::class,'id','serviciomobile_id');
    }

    public function Ubicacion(){
        return $this->hasOne(Ubicacion::class,'id','ubicacion_id');
    }

    public function User(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function Imagemobiles(){
        return $this->belongsToMany(Imagemobile::class,'denunciamobile_imagemobile','denunciamobile_id','imagemobile_id');
    }



}
