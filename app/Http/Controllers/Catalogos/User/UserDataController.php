<?php

namespace App\Http\Controllers\Catalogos\User;

use App\Classes\FiltersRules;
use App\Http\Controllers\Funciones\FuncionesController;
use App\Http\Requests\User\UserAlumnoBecasRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserDataController extends Controller
{

    protected $tableName = "users";
    protected $msg = "";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function showListUser(Request $request)
    {
        ini_set('max_execution_time', 300);
        $this->tableName = 'usuarios';
        $filters = $request->all(['search', 'roles', 'palabras_roles']);
        $items = User::query()
            ->filterBy($filters)
            ->orderByDesc('id')->take(1000)
            ->paginate(250);
        $items->appends($filters)->fragment('table');
        $user = Auth::User();
        $roles = Role::all();
        $this->msg = "";
        return view('catalogos.catalogo.user.user_list',
            [
                'items' => $items,
                'roles' => $roles,
                'checkedRoles' => collect(request('roles')),
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
                'user' => $user,
                'searchInList' => 'listUsers',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editUser',
                'newItem' => 'newUser',
                'removeItem' => 'removeUser',
                'showEditBecas' => 'showEditBecas',
                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 19,
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** EDITA LOS DATOS DEL USUARIO SOLO LECTURA ++++++++++++++++++++ //
    protected function showEditUserData()
    {
        $user = Auth::user();
        $this->msg = "";
        return view('catalogos.catalogo.user.user_profile_solo_lectura',
            [
                'user' => $user,
                'items' => $user,
                'titulo_catalogo' => "Catálogo de Usuarios",
                'titulo_header'   => 'Editando datos',
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** MANDA A LLAMAR LA PANTALLA PARA NUEVO USUARIO ++++++++++++++++++++ //
    protected function newUser()
    {
        $this->msg = "";
        return view('catalogos.catalogo.user.user_profile_new',
            [
                'titulo_catalogo' => 'Catálogo de Usuarios',
                'titulo_header'   => 'Nuevo Usuario ',
                'postNew'         => 'createUser',
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** EDITA LOS DATOS DEL USUARIO PARA ESCRITURA ++++++++++++++++++++ //
    protected function showEditUser($Id)
    {
        $user = User::find($Id);
        $this->msg = "";
        return view('catalogos.catalogo.user.user_profile_edit',
            [
                'user' => $user,
                'items' => $user,
                'titulo_catalogo' => "Catálogo de Usuarios",
                'titulo_header'   => 'Editando el Folio '.$Id,
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS EN EL USUARIO ++++++++++++++++++++ //
    protected function update(UserRequest $request)
    {
        $request->updateUser();
        $this->msg = "Registro Guardado con éxito!";
        session(['msg' => $this->msg]);
        return redirect()->route('listUsers');
    }

// ***************** GUARDA LOS CAMBIOS EN EL USUARIO ++++++++++++++++++++ //
    protected function updateUser(UserRequest $request)
    {
        $Data = $request->all(['id']);
        //dd($UserId);
        $user = $request->manageUser();
        if ( !isset($user) || !is_object($user) ) {
            $this->msg = $user;
            $user = User::find($Data['id']);
        }else{
            $this->msg = "Registro Guardado con éxito!!!";
        }
        session(['msg' => $this->msg]);

        return redirect()->route('listUsers');

    }

    protected function updateUserV2(UserRequest $request)
    {
        $Data = $request->all(['id']);
        //dd($UserId);
        $user = $request->manageUser();
        if ( !isset($user) || !is_object($user) ) {
            $this->msg = $user;
            $user = User::find($Data['id']);
        }else{
            $this->msg = "Registro Guardado con éxito!!!";
        }
        session(['msg' => $this->msg]);

        return redirect()->route('editUser',['Id'=>$request->all('id')]);

    }

// ***************** CREAR NUEVO USUARIO ++++++++++++++++++++ //
    protected function createUser(UserRequest $request){

        $Data = $request->all(['id']);
        //dd($UserId);
        $user = $request->manageUser();
        if ( !isset($user) || !is_object($user) ) {
            $this->msg = $user;
            $user = User::find($Data['id']);
        }else{
            $this->msg = "Registro Guardado con éxito!";
        }
        session(['msg' => $this->msg]);
        //dd ("Create : ".$user);
        $user = is_null($user) || trim($user) == "" ? User::all()->last() : $user;

        return view('catalogos.catalogo.user.user_profile_edit',
            [
                'user'            => $user,
                'items'           => $user,
                'titulo_catalogo' => $user->Fullname ?? '' ,
                'titulo_header'   => 'Editando...',
                'putEdit'         => 'EditUser',
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** MUESTRA LA EDICIÓMN DE FOTO ++++++++++++++++++++ //
    protected function showEditProfilePhoto()
    {
        $user = Auth::user();
        $titulo_catalogo = "";
        $this->msg = "";
        return view('catalogos.catalogo.user.user_photo_update', [
                "user" => $user,
                "titulo_catalogo" => "Catálogo de Usuarios",
                'titulo_header'   => 'Actualizando avatar',
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** MUESTRA LA EDICIÓN DEL PASSWORD ++++++++++++++++++++ //
    protected function showEditProfilePassword()
    {
        $user = Auth::user();
        $titulo_catalogo = "";
        $this->msg = "";
        session(['msg' => $this->msg]);
        return view('catalogos.catalogo.user.user_password_edit', [
                "user" => $user,
                "titulo_catalogo" =>"Catálogo de Usuarios",
                'titulo_header'   => 'Actualizando password',
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** CAMBIA EL PASSWORD ++++++++++++++++++++ //
    protected function changePasswordUser(UserUpdatePasswordRequest $request)
    {
        $request->updateUserPassword();
        $titulo_catalogo = "";
        $this->msg = "";
        session(['msg' => $this->msg]);
        return view('catalogos.catalogo.user.user_password_edit', [
            "user" => Auth::user(),
            "msg" => 'Password cambiado con éxito!',
            "titulo_catalogo" =>"Catálogo de Usuarios",
            'titulo_header'   => 'Editando password',
            'msg'             => $this->msg,
        ]);
    }

// ***************** ELIMINA AL USUARIO VIA AJAX ++++++++++++++++++++ //
    protected function removeUser($id = 0)
    {
        If ($id > 3){
            $user = User::withTrashed()->findOrFail($id);
            if (isset($user)) {
                if (!$user->trashed()) {
                    $user->forceDelete();
                } else {
                    $user->forceDelete();
                }
                return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
            } else {
                return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
            }
        }else{
            return Response::json(['mensaje' => 'Este usuario no se puede eliminar', 'data' => 'Error', 'status' => '200'], 200);
        }
    }


// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function searchUser(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters =$request->input('search');
        $F           = new FuncionesController();
        $tsString    = $F->string_to_tsQuery( strtoupper($filters),' & ');
        $items = User::query()
            ->search($tsString)
            ->orderBy('id')->take(50)
            ->get();
        $data=array();

        foreach ($items as $item) {
            $data[]=array(
                'value'=>$item->fullName.' - '.$item->curp,
                'domicilio'=>$item->ubicaciones()->first()->Ubicacion,
                'id'=>$item->id,
            );
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No se encontraron resultados','id'=>0];

    }

// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function getUser($Id=0)
    {
        $items = User::find($Id);
        $items->domicilio = $items->ubicaciones()->first()->Ubicacion;
        $items->ubicacion_id = $items->ubicaciones()->first()->id;
        $items->nombre_completo = $items->FullName;
        //dd($items);
        return Response::json(['mensaje' => 'OK', 'data' => json_decode($items), 'status' => '200'], 200);

    }



}
