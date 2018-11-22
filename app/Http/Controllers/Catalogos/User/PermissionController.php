<?php

namespace App\Http\Controllers\Catalogos\User;

use App\User;
use Illuminate\Foundation\Auth\Access\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    use Authorizable;

    protected $tableName = '';
    protected $lstAsigns = "";
    protected $redirectTo = '/home';

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($Id = 0){
        $listEle     = Permission::select('id','name as data')->pluck('data','id');
        $listTarget  = User::all()->sortBy(function($item) {
            return $item->ap_paterno.' '.$item->ap_materno.' '.$item->nombre;
        });
        $Id = $Id == 0 ? 1 : $Id;
        $users = User::findOrFail($Id);
        $this->lstAsigns = $users->permissions->pluck('name','id');

        $user = Auth::User();
        return view ('catalogos.asignaciones.permissions_usuario',
            [
                'listEle0' => $listEle,
                'listTarget0' => $listTarget,
                'lstAsigns0' => $this->lstAsigns,
                'titulo_catalogo' => "Asignación de Permisos",
                'user' => $user,
                'Id' => $Id,
                'titleLeft0'  => "Permisos",
                'titleUsuario0' => "Usuario",
                'titleAsign0'  => "Permisos asignados",
                'urlAsigna'   => "assignPermissionToUser",
                'urlRegresa'  => "asignaPermission",
                'urlElimina'  => "unAssignPermissionToUser",
            ]
        );

    }

    public function asignar($Id, $namePermissions)
    {
        $user = User::findOrFail($Id);
//        dd($user->username);
        $permissions = explode('|',$namePermissions);
        foreach($permissions AS $i=>$valor) {
            if ($permissions[$i] !== ""){
                $permission = Permission::where('id', $permissions[$i])->first();
//                dd($permission);
                $rl = $user->hasPermissionTo($permission->name); // Permission::where('name',$perm)->count();
                if (!$rl) {
                    $user->permissions()->attach($permission);
                    if ($permissions[$i] === 'administrator'){
                        $user->admin = true;
                        $user->save();
                    }
                }
            }
        }
        return Response::json(['mensaje' => "/asignaPermission/$Id", 'data' => 'OK', 'status' => '200'], 200);

    }

    public function desasignar($Id, $namePermissions)
    {
        $user = User::findOrFail($Id);
        $permissions = explode('|',$namePermissions);
        foreach($permissions AS $i=>$valor) {
            if ($permissions[$i] !== "") {
                $permission = Permission::where('id', $permissions[$i])->first();
                $user->revokePermissionTo($permission->name);
                if ($permissions[$i] === 'administrator'){
                    $user->admin = false;
                    $user->save();
                }

            }
        }
        return Response::json(['mensaje' => "/asignaPermission/$Id", 'data' => 'OK', 'status' => '200'], 200);
    }

}
