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
        //dd( $search );
        $IsEnlace =Auth::user()->isRole('ENLACE');
        $DependenciaArray = '';
        IF ($IsEnlace){
            $DependenciaArray = Auth::user()->DependenciaArray;
            $filters['dependencia'] = $DependenciaArray;
//            dd('hola 1');
        }elseif ( Auth::user()->isRole('CIUDADANO|DELEGADO') && !Auth::user()->isRole('Administrator|SysOp') ){
            $filters['ciudadano_id'] = Auth::user()->id;
//            dd('hola 2');
        }else{
            $filters['search'] = $search;
//            dd('hola 3');
        }
        session(['IsEnlace' => $IsEnlace]);
        session(['DependenciaArray' => $DependenciaArray]);
        //dd($filters);
        return $query->filterBy($filters);

    }

    public function validIsEnlace(){

    }


}
