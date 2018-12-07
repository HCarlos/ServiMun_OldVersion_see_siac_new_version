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
                ->orWhereRaw("UPPER(descripcion) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(referencia) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(calle) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(colonia) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(localidad) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(ciudad) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(municipio) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(estado) like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        });

    }






}
