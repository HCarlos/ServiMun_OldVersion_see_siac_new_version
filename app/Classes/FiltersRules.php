<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 21/11/18
 * Time: 06:36 PM
 */

namespace App\Classes;


use Illuminate\Http\Request;
use App\Role;

class FiltersRules
{

//    public function filterRulesBecasAlumno(Request $request, string $role_user ){
//        $data = $request->all(['becas','search']);
//        $data['becas'] = $data['becas']==null ? "" : $data['becas'];
//        $data['search'] = $data['search']==null ? "" : $data['search'];
//        $role = Role::all()->where('name',$role_user)->first();
//        $filters = [
//            'search' => $data['search'],
//            'roles'  => [$role->id],
//            'becas'  => $data['becas'],
//        ];
//        return $filters;
//    }

    public function filterRulesDenuncia(Request $request){
        $data = $request->all(['ciudadano','id','desde','hasta','dependencia_id','servicio_id','estatus_id']);
        $data['ciudadano'] = $data['ciudadano']==null ? "" : $data['ciudadano'];
        $data['id'] = $data['id']==null ? "" : $data['id'];
        $data['desde'] = $data['desde']==null ? "" : $data['desde'];
        $data['hasta'] = $data['hasta']==null ? "" : $data['hasta'];
        $data['dependencia_id'] = $data['dependencia_id']==null ? "" : $data['dependencia_id'];
        $data['servicio_id'] = $data['servicio_id']==null ? "" : $data['servicio_id'];
        $data['estatus_id'] = $data['estatus_id']==null ? "" : $data['estatus_id'];
        $filters = [
            'ciudadano'      => $data['ciudadano'],
            'id'             => $data['id'],
            'desde'          => $data['desde'],
            'hasta'          => $data['hasta'],
            'dependencia_id' => $data['dependencia_id'],
            'servicio_id'    => $data['servicio_id'],
            'estatus_id'     => $data['estatus_id'],
        ];
        dd($filters);
        return $filters;
    }

}
