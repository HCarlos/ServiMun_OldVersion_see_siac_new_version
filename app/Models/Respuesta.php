<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respuesta extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'respuestas';

    protected $fillable = [
        'id', 'fecha','respuesta','observaciones','denuncia_id','user_id',
    ];

    public function Denuncia() {
        return $this->hasMany(Denuncia::class,'denuncia_id');
    }

    public function Users() {
        return $this->hasMany(User::class,'user_id');
    }

}
