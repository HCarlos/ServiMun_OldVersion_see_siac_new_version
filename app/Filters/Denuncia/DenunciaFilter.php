<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 30/11/18
 * Time: 01:03 PM
 */

namespace App\Filters\Denuncia;


use App\Filters\Common\QueryFilter;
use App\Models\Catalogos\Dependencia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DenunciaFilter extends QueryFilter
{


    public function rules(): array{
        return [
            'search'         => '',
            'curp'           => '',
            'ciudadano'      => '',
            'id'             => '',
            'desde'          => '',
            'hasta'          => '',
            'dependencia_id' => '',
            'servicio_id'    => '',
            'estatus_id'     => '',
            'ciudadano_id'   => '',
            'dependencia'   => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);

//        $IsEnlace = Session::get('IsEnlace');
//        if($IsEnlace==false){
//            $DependenciaArray = explode('|',Session::get('DependenciaArray'));
//            $Dependencias = Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');
//        }else{
//            $Dependencias = Dependencia::all()->sortBy('dependencia');
//        }
//
        return $query->where(function ($query) use ($search) {
                $query->orWhereHas('ciudadanos', function ($q) use ($search) {
                    return $q->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%");
                })
                ->orWhereHas('dependencia', function ($q) use ($search) {
                    if ($this->IsEnlace()){
                        return $q->whereIn('dependencia',$this->getDependencia(),true);
                    }else{
                        return $q->whereRaw("UPPER(dependencia) like ?", "%{$search}%");
                    }
                })
                ->orWhereHas('estatus', function ($q) use ($search) {
                    return $q->whereRaw("UPPER(estatus) like ?", "%{$search}%")
                        ->where('ultimo',true);
                })
                ->orWhereRaw("UPPER(descripcion) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(referencia) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(calle) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(colonia) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(comunidad) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(ciudad) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(municipio) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(estado) like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        });

    }

    public function curp($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->orWhereHas('ciudadanos', function ($q) use ($search) {
            return $q->where("curp",trim($search));
        });
    }

    public function ciudadano($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->orWhereHas('ciudadanos', function ($q) use ($search) {
            return $q->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%");
        });
    }

    public function id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
//        $search = strtoupper($search);
        return $query->where('id', $search);
    }

    public function desde($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $date = Carbon::createFromFormat('Y-m-d', $search)->toDateString();
        $date = $date.' 00:00:00';
        return $query->whereDate('fecha_ingreso', '>=', $date);
    }

    public function hasta($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $date = Carbon::createFromFormat('Y-m-d', $search)->toDateString();
        $date = $date.' 23:59:59';
        return $query->whereDate('fecha_ingreso', '<=', $date);
    }

    public function dependencia_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}

        return $query->whereHas('dependencia', function ($q) use ($search) {
            if ($this->IsEnlace()){
//                dd( $this->getDependenciaId() );
                return $q->whereIn('dependencia_id',$this->getDependenciaId());
            }else{
                return $q->where('dependencia_id', $search);
            }
        });

    }

    public function servicio_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
//        $search = strtoupper($search);
        return $query->where('servicio_id', $search);
    }

    public function estatus_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
//        $search = strtoupper($search);
        return $query->where('estatus_id', $search);
    }

    public function ciudadano_id($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        return $query->where('ciudadano_id', $search);
    }

    public function dependencias($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "0") {return $query;}
        $search = explode('|',$search);
        return $query->orWhereHas('dependencia', function ($q) use ($search) {
            return $q->whereIn('dependencia',$search);
        });

    }

    function IsEnlace(){
        return Session::get('IsEnlace');
//        if($IsEnlace){
//            $DependenciaArray = explode('|',Session::get('DependenciaArray'));
//            $Dependencias = Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');
//        }else{
//            $Dependencias = Dependencia::all()->sortBy('dependencia');
//        }
    }

    function getDependencia(){
            return $DependenciaArray = explode('|',Session::get('DependenciaArray'));
            //return Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');
    }

    function getDependenciaId(){
        $depId = Auth::user()->DependenciaIdArray;
        return $DependenciaIdArray = explode('|',$depId);
        //return Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');
    }

}
