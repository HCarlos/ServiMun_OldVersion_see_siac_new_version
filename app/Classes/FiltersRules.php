<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 21/11/18
 * Time: 06:36 PM
 */

namespace App\Classes;


use App\User;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Auth;

class FiltersRules
{

    public function filterRulesDenuncia(Request $request){
        $data = $request->all(['curp','ciudadano','id','desde','hasta','dependencia_id','servicio_id','estatus_id','creadopor_id','incluirFecha','conRespuesta','clave_identificadora','uuid']);
        $data['curp']                 = $data['curp']                 == null ? "" : $data['curp'];
        $data['ciudadano']            = $data['ciudadano']            == null ? "" : $data['ciudadano'];
        $data['id']                   = $data['id']                   == null ? "" : $data['id'];
        $data['desde']                = $data['desde']                == null ? "" : $data['desde'];
        $data['hasta']                = $data['hasta']                == null ? "" : $data['hasta'];
        $data['incluirFecha']         = $data['incluirFecha']         == null ? "" : $data['incluirFecha'];
        $data['conRespuesta']         = $data['conRespuesta']         == null ? "" : $data['conRespuesta'];
        $data['clave_identificadora'] = $data['clave_identificadora'] == null ? "" : $data['clave_identificadora'];
        $data['uuid']                 = $data['uuid']                 == null ? "" : $data['uuid'];

//        if ( Auth::user()->isRole('ENLACE') ) {
//            $data['dependencia_id'] = Auth::user()->IsEnlaceDependencia;
//        }else{
//            $data['dependencia_id'] = $data['dependencia_id'] == "0" ? "" : $data['dependencia_id'];
//        }

        $data['dependencia_id'] = $data['dependencia_id'] == "0" ? "" : $data['dependencia_id'];

        $data['servicio_id']    = $data['servicio_id']    == "" || $data['servicio_id']    == "0'" ? "" : $data['servicio_id'];
        $data['estatus_id']     = $data['estatus_id']     == "0" ? "" : $data['estatus_id'];
        $data['creadopor_id']   = $data['creadopor_id']   == "0" ? "" : $data['creadopor_id'];
        $filters = [
            'curp'           => $data['curp'],
            'ciudadano'      => $data['ciudadano'],
            'id'             => $data['id'],
        ];
        if ($data['incluirFecha'] != null){
            $filters = array_merge($filters, ['desde' => $data['desde'], 'hasta' => $data['hasta'] ] );
        }
        $filters = array_merge($filters, [
            'dependencia_id'       => $data['dependencia_id'],
            'servicio_id'          => $data['servicio_id'],
            'estatus_id'           => $data['estatus_id'],
            'creadopor_id'         => $data['creadopor_id'],
            'conrespuesta'         => $data['conRespuesta'],
            'clave_identificadora' => $data['clave_identificadora'],
            'uuid'                 => $data['uuid'],
            'incluirFecha'         => $data['incluirFecha'],
        ]);

//        dd($filters);

        return $filters;

    }

}
