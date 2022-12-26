<?php

namespace App\Models\Mobiles;

use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Origen;
use App\Traits\Denuncia\DenunciaTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denunciamobile extends Model{

//    use SoftDeletes;

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
        'megusta',
        'user_id',
        'searchtextubicacion',
    ];

    protected $dates = ['fecha' => 'datetime:d-m-Y'];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        $search = strtoupper($search);
        $filters  = $search;
        $F        = new FuncionesController();
        $tsString = $F->string_to_tsQuery( strtoupper($filters),' & ');
        return $query->whereRaw("searchtextubicacion @@ to_tsquery('spanish', ?)", [$tsString])
            ->orderByRaw("ubicacion ASC");
    }


    public function Servicio(){
        return $this->hasOne(Serviciomobile::class,'id','serviciomobile_id');
    }

    public function Ubicacion(){
        return $this->hasOne(Ubicacion::class,'id','ubicacion_id');
    }

    public function User(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function ciudadanos(){
        return $this->belongsToMany(User::class,'ciudadanomobile_denunciamobile','denunciamobile_id','ciudadanomobile_id');
    }

    public function Imagemobiles(){
        return $this->belongsToMany(Imagemobile::class,'denunciamobile_imagemobile','denunciamobile_id','imagemobile_id');
    }



}
