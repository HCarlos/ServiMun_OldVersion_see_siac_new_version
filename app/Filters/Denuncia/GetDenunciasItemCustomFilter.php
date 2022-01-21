<?php
/*
 * Copyright (c) 2021. Realizado por Carlos Hidalgo
 */

namespace App\Filters\Denuncia;

use App\Filters\Common\QueryFilter;
use Illuminate\Support\Facades\Auth;

class GetDenunciasItemCustomFilter extends QueryFilter{


    public function rules(): array{
        return [
            'filterdata' => ''
        ];
    }

    public function filterdata($query, $search){
        $search = isset($search['search']) ? $search['search'] : '';
        $search = strtoupper($search);
//        dd( $search );
        $IsEnlace =Auth::user()->isRole('ENLACE');
        $IsAdminArchivo =Auth::user()->isRole('USER_ARCHIVO_ADMIN');
        $DependenciaArray = '';
        $DependenciaIdArray = 0;
        IF ($IsEnlace) {
            $DependenciaIdArray = Auth::user()->DependenciaIdArray;
            $filters['dependencia_id'] = $DependenciaIdArray;
        }elseif ($IsAdminArchivo){
                $filters['cerrado'] = 'true';
        }elseif ( Auth::user()->isRole('CIUDADANO|DELEGADO') && !Auth::user()->isRole('Administrator|SysOp') ){
            $filters['ciudadano_id'] = Auth::user()->id;
            //dd("2");
        }else{
            $filters['search'] = $search;
            //dd("3");
        }
        session(['IsEnlace' => $IsEnlace]);
        session(['IsAdminArchivo' => $IsAdminArchivo]);
        session(['DependenciaArray' => $DependenciaArray]);
        session(['DependenciaIdArray' => $DependenciaIdArray]);

//        dd($filters);

        return $query->filterBy($filters);

    }

    public function validIsEnlace(){

    }


}
