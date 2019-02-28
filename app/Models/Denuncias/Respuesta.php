<?php
/**
 * Copyright (c) 2019. Realizado por Carlos Hidalgo
 */

namespace App\Models\Denuncias;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respuesta extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'respuestas';

    protected $fillable = [
        'id', 'fecha','respuesta','observaciones','denuncia__id','user__id'
    ];

//    public function Denuncia() {
//        return $this->hasMany(Denuncia::class,'denuncia_id');
//    }

//    public function Users() {
//        return $this->hasMany(User::class,'user_id');
//    }
//

    public function user(){
        return $this->hasOne(User::class,'id','user__id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'respuesta_user','respuesta_id','user_id');
    }

    public function denuncia(){
        return $this->hasOne(Denuncia::class,'id','denuncia__id');
    }

    public function denuncias(){
        return $this->belongsToMany(Denuncia::class,'denuncia_respuesta','respuesta_id','denuncia_id');
    }

}
