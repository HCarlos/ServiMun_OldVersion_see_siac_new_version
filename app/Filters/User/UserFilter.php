<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 21/11/18
 * Time: 06:32 PM
 */

namespace App\Filters\User;

use App\Filters\Common\QueryFilter;

class UserFilter extends QueryFilter {

    public function rules(): array{
        return [
            'search' => '',
            'roles' => '',
            'becas' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%")
                ->orWhereRaw("UPPER(username) like ?", "%{$search}%")
                ->orWhereHas('roles', function ($q) use ($search) {
                    $q->whereRaw("UPPER(name) like ?", "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
        });
    }

    public function roles($query, $roles){
        if (is_null($roles) ) {return $query;}
        if (empty ($roles)) {return $query;}
        return $query->whereHas('roles', function ($q) use ($roles) {
            $q->whereIn('role_id', $roles);
        });
    }

    public function becas($query, $beca){
        if (is_null($beca) || empty ($beca) || $beca == 'beca_none') {return $query;}
        return $query->whereHas('user_becas', function ($q) use ($beca) {
            $q->where($beca,'>', 0);
        });
    }


}
