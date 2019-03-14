<?php

namespace App\Models\Denuncias;

use App\Traits\Denuncia\ImageneTrait;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Imagene extends Model{
    use SoftDeletes;
    use ImageneTrait;

    protected $guard_name = 'web';
    protected $table = 'imagenes';
    protected $disk = "denuncia";

    protected $fillable = [
        'id', 'fecha','root','image','image_thumb','titulo','descripcion','momento','denuncia__id','user__id'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user__id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'imagene_user','imagene_id','user_id');
    }

    public function denuncia(){
        return $this->hasOne(Denuncia::class,'id','denuncia__id');
    }

    public function denuncias(){
        return $this->belongsToMany(Denuncia::class,'denuncia_imagene','imagene_id','denuncia_id');
    }



}
