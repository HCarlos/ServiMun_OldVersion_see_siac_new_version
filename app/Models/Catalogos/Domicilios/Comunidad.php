<?php

namespace App\Models\Catalogos\Domicilios;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunidad extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'comunidades';

    protected $fillable = [
        'id', 'comunidad','user_id','tipocomunidad_id',
    ];

    public function Delegado() {
        return $this->hasOne(User::class,'user_id');
    }

    public function TipoComunidad() {
        return $this->hasOne(Tipocomunidad::class,'tipocomunidad_id');
    }

    public static function findOrImport($comunidad,$user_id,$tipocomunidad_id){
        $obj = static::where('comunidad', $comunidad)->first();
        if (!$obj) {
            $obj = static::create([
                'comunidad' => strtoupper($comunidad),
                'user_id' => $user_id,
                'tipocomunidad_id' => $tipocomunidad_id,
            ]);
        }
        return $obj;
    }



}
