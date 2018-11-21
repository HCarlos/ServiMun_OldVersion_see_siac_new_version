<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserDataExtend extends Model
{
    use Notifiable, SoftDeletes;

    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'user_extend';

    protected $fillable = [
        'id','user_id',
        'dias_credito','limite_credito','saldo_a_favor','saldo_en_contra',
        'lugar_nacimiento','ocupacion','profesion','lugar_trabajo',
    ];

//    public function users(){
//        return $this->hasMany(Users::class);
//    }

}
