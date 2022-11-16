<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 30/11/18
 * Time: 01:03 PM
 */

namespace App\Filters\Denuncia;


use App\Filters\Common\QueryFilter;
use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Denuncias\Denuncia_Dependencia_Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DenunciaFilter extends QueryFilter
{


    public function rules(): array{
        return [
            'search'                 => '',
            'curp'                   => '',
            'ciudadano'              => '',
            'id'                     => '',
            'desde'                  => '',
            'hasta'                  => '',
            'dependencia_id'         => '',
            'servicio_id'            => '',
            'origen_id'              => '',
            'estatus_id'             => '',
            'fecha_movimiento'       => '',
            'ciudadano_id'           => '',
            'creadopor_id'           => '',
            'dependencia'            => '',
            'conrespuesta'           => '',
            'cerrado'                => '',
            'clave_identificadora'   => '',
            'uuid'                   => '',
        ];
    }

//'fecha_movimiento_desde' => '',
//'fecha_movimiento_hasta' => '',

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        $filters  = $search;
        $F        = new FuncionesController();
        $tsString = $F->string_to_tsQuery( strtoupper($filters),' & ');

        return $query->whereRaw("searchtextdenuncia @@ to_tsquery('spanish', ?)", [$tsString])
            ->orderByRaw("calle, num_ext, num_int, colonia, descripcion, referencia ASC");


//        return $query->where(function ($query) use ($search, $tsString) {
//                $query->orWhereHas('ciudadanos', function ($q) use ($search) {
//                    return $q->whereRaw("CONCAT( UPPER(TRIM(ap_paterno)),' ',UPPER(TRIM(ap_materno)),' ',UPPER(TRIM(nombre)) ) like ?", "%{$search}%")
//                        ->orWhereRaw("UPPER(curp) like ?", "%{$search}%");
//                })
//                ->orWhereHas('estatus', function ($q) use ($search) {
//                    return $q->whereRaw("UPPER(estatus) like ?", "%{$search}%")
//                        ->where('ultimo',true);
//                })
//                ->orWhereRaw("searchtextdenuncia @@ to_tsquery('spanish', ?)", [$tsString])
//                ->orWhere('id', intval($search));
//        });

    }

//->orWhereHas('dependencias', function ($q) use ($search) {
//                    if ($this->IsEnlace()){
//                        return $q->whereIn('dependencia_id',$this->getDependenciaId(),true);
//                    }else{
//    return $q->whereRaw("UPPER(dependencia) like ?", "%{$search}%");
//}
//})

//->orWhere('cerrado', settype($search, 'boolean'))

//->orWhereRaw("UPPER(descripcion) like ?", "%{$search}%")
//->orWhereRaw("UPPER(referencia) like ?", "%{$search}%")
//    ->orWhereRaw("UPPER(calle) like ?", "%{$search}%")
//    ->orWhereRaw("UPPER(colonia) like ?", "%{$search}%")
//    ->orWhereRaw("UPPER(comunidad) like ?", "%{$search}%")
//    ->orWhereRaw("UPPER(ciudad) like ?", "%{$search}%")
//    ->orWhereRaw("UPPER(municipio) like ?", "%{$search}%")
//    ->orWhereRaw("UPPER(estado) like ?", "%{$search}%")


//    public function searchToo($query, $search){
//        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
//        $search = strtoupper($search);
//
//        $items = $query
//            ->search($tsString);
//
//    }


    public function curp($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->orWhereHas('ciudadanos', function ($q) use ($search) {
//            dd($search);
            return $q->where("curp",strtoupper(trim($search)));
        });
    }

    public function ciudadano($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->orWhereHas('ciudadanos', function ($q) use ($search) {
//            dd($q->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%"));
//            dd($search);

//            return $q->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%");

            $filters  = $search;
            $F        = new FuncionesController();
            $tsString = $F->string_to_tsQuery( strtoupper($filters),' & ');
            return $q->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$tsString]);

        });
    }

    public function id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        return $query->where('id', $search);
    }

    public function desde($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $date = Carbon::createFromFormat('Y-m-d', $search)->toDateString();
        $date = $date.' 00:00:00';
        return $query->whereDate('fecha_ingreso', '>=', $date);
//        return $query->whereHas('ultimo_estatu_denuncia_dependencia_servicio', function ($q) use ($date) {
//            return $q->whereDate('fecha_movimiento', '>=', $date);
//        });
    }

    public function hasta($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $date = Carbon::createFromFormat('Y-m-d', $search)->toDateString();
        $date = $date.' 23:59:59';
        return $query->whereDate('fecha_ingreso', '<=', $date);
//        return $query->whereHas('ultimo_estatu_denuncia_dependencia_servicio', function ($q) use ($date) {
//            return $q->whereDate('fecha_movimiento', '<=', $date);
//        });
    }

    public function dependencia_id($query, $search){
        if (!auth()->user()->hasAnyPermission(['buscar_solo_en_su_ámbito'])) {
            if (is_null($search) || empty($search) || (isset($search) == false)) {
                return $query;
            }
        }
        if ( !is_array($search) ){
            if (intval($search) == 0){
                $search = Auth::user()->DependenciaIdArray;
//                return $query;
            }
        }
        return $query->whereHas('dependencias', function ($q) use ($query, $search) {
                if ( is_array($search) ){
//                    dd($search);
                    return $q->whereIn('dependencia_id', $search);
                }else{
                    return $q->where('dependencia_id', intval($search) );
                }
        });
    }

    public function servicio_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0" || trim($search) == "") {return $query;}
        return $query->whereHas('denuncia_servicios', function ($q) use ($query, $search) {
            return $q->where('servicio_id', intval($search));
        });
    }

    public function estatus_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}

        return $query->whereHas('denuncia_estatus', function ($q) use ($query, $search) {
            return $q->where('estatu_id', intval($search));
        });

    }

    public function fecha_movimiento($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
//        return $query->whereHas('denuncia_servicios', function ($q) use ($search) {
            $cad = explode('|',$search);
            $fdesde = $cad[0];
            $fhasta = $cad[1];
            $estatu = intval($cad[2]);
            $depend = intval($cad[3]);
            $date1 = Carbon::createFromFormat('Y-m-d', $fdesde)->toDateString();
            $date1 = $date1.' 00:00:00';
            $date2 = Carbon::createFromFormat('Y-m-d', $fhasta)->toDateString();
            $date2 = $date2.' 23:59:59';

            return $query->whereHas('ultimo_estatu_denuncia_dependencia_servicio', function ($q) use ($search, $date1, $date2, $estatu, $depend) {
                $arr = Auth::user()->DependenciaIdArray;
                if (auth()->user()->hasAnyPermission(['buscar_solo_en_su_ámbito'])) {
                    if ($estatu > 0){
                        if ( is_array($arr) ) return $q->whereIn('dependencia_id',$arr)->where('estatu_id', $estatu)->whereDate('fecha_movimiento', '>=', $date1)->whereDate('fecha_movimiento', '<=', $date2);
                        else {
                            if ($arr > 0) return $q->where('dependencia_id', $arr)->where('estatu_id', $estatu)->whereDate('fecha_movimiento', '>=', $date1)->whereDate('fecha_movimiento', '<=', $date2);
                            else return $q->where('estatu_id', $estatu)->whereDate('fecha_movimiento', '>=', $date1)->whereDate('fecha_movimiento', '<=', $date2);
                        }
                    }
                }else{
                    if ($estatu > 0){
                        if ($depend > 0) return $q->where('dependencia_id', $depend)->where('estatu_id', $estatu)->whereDate('fecha_movimiento', '>=', $date1)->whereDate('fecha_movimiento', '<=', $date2);
                        else return $q->where('estatu_id', $estatu)->whereDate('fecha_movimiento', '>=', $date1)->whereDate('fecha_movimiento', '<=', $date2);
                    }else{
                        if ($depend > 0) return $q->where('dependencia_id', $depend)->whereDate('fecha_movimiento', '>=', $date1)->whereDate('fecha_movimiento', '<=', $date2);
                        else return $q->whereDate('fecha_movimiento', '>=', $date1)->whereDate('fecha_movimiento', '<=', $date2);
                    }
                }
            });

//        });
    }

    public function origen_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        return $query->where('origen_id', $search);
    }

    public function ciudadano_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        return $query->where('ciudadano_id', $search);
    }

    public function creadopor_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        return $query->where('creadopor_id', $search);
    }

    public function dependencia($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        $search = explode('|',$search);
        return $query->orWhereHas('dependencia', function ($q) use ($search) {
            return $q->whereIn('dependencia',$search);
        });

    }

    public function conrespuesta($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        $search = explode('|',$search);
        if ($search==true)
            return $query->has('denuncia_estatus','>',1)->withCount('denuncia_estatus');
    }

    public function cerrado($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        return $query->orWhere('cerrado',settype($search, 'boolean'));
    }

    public function clave_identificadora($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        return $query->orWhere('clave_identificadora',$search);
    }

    public function uuid($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        $search = strtolower(trim($search));
        return $query->orWhere('uuid',trim($search));
    }



    function IsEnlace(){
        return Session::get('IsEnlace');
    }

    function getDependencia(){
            return $DependenciaArray = explode('|',Session::get('DependenciaArray'));
    }

    function getDependenciaId(){
        return $DependenciaIdArray = explode('|',Session::get('DependenciaIdArray'));
    }


}
