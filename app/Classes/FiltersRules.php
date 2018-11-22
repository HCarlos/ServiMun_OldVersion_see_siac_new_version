<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 21/11/18
 * Time: 06:36 PM
 */

namespace App\Classes;


use Illuminate\Http\Request;
use App\Role;

class FiltersRules
{

    public function filterRulesBecasAlumno(Request $request, string $role_user ){
//        dd($request);
        $data = $request->all(['becas','search']);
        $data['becas'] = $data['becas']==null ? "" : $data['becas'];
        $data['search'] = $data['search']==null ? "" : $data['search'];
        $role = Role::all()->where('name',$role_user)->first();
        $filters = [
            'search' => $data['search'],
            'roles'  => [$role->id],
            'becas'  => $data['becas'],
        ];
//        dd($filters);
        return $filters;
    }

}
