<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 27/11/18
 * Time: 05:50 PM
 */

namespace App\Traits\Catalogos\Domicilio\Comunidad;


use App\User;

trait ComunidadTrait
{

    public static function findOrImport($comunidad,$user_id,$tipocomunidad_id){
        $obj = static::where('comunidad', $comunidad)
            ->where('delegado_id', $user_id)
            ->first();
        if (!$obj) {
            $obj = static::create([
                'comunidad' => strtoupper($comunidad),
                'delegado_id' => $user_id,
                'tipocomunidad_id' => $tipocomunidad_id,
            ]);
        }
        return $obj;
    }


}
