<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 30/11/18
 * Time: 01:03 PM
 */

namespace App\Filters\Denuncia;


use App\Filters\Common\QueryFilter;

class DenunciaFilter extends QueryFilter
{


    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query
                ->orWhereHas('descripcion', function ($q) use ($search) {
                    $q->whereRaw("UPPER(descripcion) like ?", "%{$search}%");
                })
                ->orWhereHas('referencia', function ($q) use ($search) {
                    $q->whereRaw("UPPER(referencia) like ?", "%{$search}%");
                })
                ->orWhereHas('calle', function ($q) use ($search) {
                    $q->whereRaw("UPPER(calle) like ?", "%{$search}%");
                })
                ->orWhereHas('colonia', function ($q) use ($search) {
                    $q->whereRaw("UPPER(colonia) like ?", "%{$search}%");
                })
                ->orWhereHas('localidad', function ($q) use ($search) {
                    $q->whereRaw("UPPER(localidad) like ?", "%{$search}%");
                })
                ->orWhereHas('ciudad', function ($q) use ($search) {
                    $q->whereRaw("UPPER(ciudad) like ?", "%{$search}%");
                })
                ->orWhereHas('municipio', function ($q) use ($search) {
                    $q->whereRaw("UPPER(municipio) like ?", "%{$search}%");
                })
                ->orWhereHas('estado', function ($q) use ($search) {
                    $q->whereRaw("UPPER(municipio) like ?", "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
        });

    }






}
