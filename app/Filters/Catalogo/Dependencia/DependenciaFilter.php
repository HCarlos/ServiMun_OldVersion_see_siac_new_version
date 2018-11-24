<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 23/11/18
 * Time: 04:35 PM
 */

namespace App\Filters\Catalogo\Dependencia;


use App\Filters\Common\QueryFilter;

class DependenciaFilter extends QueryFilter
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
            $query->whereRaw("UPPER(dependencia) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(abreviatura) like ?", "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        });
    }

}
