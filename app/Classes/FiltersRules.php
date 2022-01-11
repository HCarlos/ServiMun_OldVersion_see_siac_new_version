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

    public function filterRulesDenuncia(Request $request){
        $data = $request->all(['curp','ciudadano','id','desde','hasta','dependencia_id','servicio_id','estatus_id','creadopor_id']);
        $data['curp']           = $data['curp']           == null ? "" : $data['curp'];
        $data['ciudadano']      = $data['ciudadano']      == null ? "" : $data['ciudadano'];
        $data['id']             = $data['id']             == null ? "" : $data['id'];
        $data['desde']          = $data['desde']          == null ? "" : $data['desde'];
        $data['hasta']          = $data['hasta']          == null ? "" : $data['hasta'];
        $data['dependencia_id'] = $data['dependencia_id'] == null ? "" : $data['dependencia_id'];
        $data['servicio_id']    = $data['servicio_id']    == null ? "" : $data['servicio_id'];
        $data['estatus_id']     = $data['estatus_id']     == null ? "" : $data['estatus_id'];
        $data['creadopor_id']   = $data['creadopor_id']   == null ? "" : $data['creadopor_id'];
        $filters = [
            'curp'           => $data['curp'],
            'ciudadano'      => $data['ciudadano'],
            'id'             => $data['id'],
            'desde'          => $data['desde'],
            'hasta'          => $data['hasta'],
            'dependencia_id' => $data['dependencia_id'],
            'servicio_id'    => $data['servicio_id'],
            'estatus_id'     => $data['estatus_id'],
            'creadopor_id'   => $data['creadopor_id'],
        ];
        //dd($filters);
        return $filters;
    }

}
