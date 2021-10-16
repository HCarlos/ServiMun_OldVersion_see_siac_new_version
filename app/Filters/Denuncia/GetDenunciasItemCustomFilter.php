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
        //dd( $filter );
        $IsEnlace =Auth::user()->isRole('ENLACE');
        $DependenciaArray = '';
        IF ($IsEnlace){
            $DependenciaArray = Auth::user()->DependenciaArray;
            $filters['dependencias'] = $DependenciaArray;
        }elseif (Auth::user()->isRole('CIUDADANO|DELEGADO')){
            $filters['ciudadano_id'] = Auth::user()->id;

        }else{
            $filters['search'] = $search;
        }
        session(['IsEnlace' => $IsEnlace]);
        session(['DependenciaArray' => $DependenciaArray]);
        //dd($filters);
        return $query->filterBy($filters);

    }

    public function validIsEnlace(){

    }


}
