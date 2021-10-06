<?php

namespace App\Http\Requests\User;

use App\Classes\MessageAlertClass;
use App\Http\Controllers\Funciones\FuncionesController;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $redirectRoute = 'editUser';

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'ap_paterno' => ['required', 'string'],
            'nombre'     => ['required', 'string'],

        ];
    }

    public function messages()
    {
        return [

            'nombre.required' => 'Se requiere el :attribute',
            'nombre.min' => 'El :attribute requiere por lo menos de 1 caracter',
            'ap_paterno.required' => 'Se requiere el :attribute',
            'ap_paterno.min' => 'El :attribute requiere por lo menos de 1 caracter',

        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'Nombre',
            'ap_paterno' => 'Apellido Paterno',
        ];
    }

    public function manageUser()
    {
        if ($this->id == 0) {

            $UN       =  User::getUsernameNext('CIU');
            $Username = $UN['username'];
            $Email    = strtolower(trim($this->email));
            $Email2   =  strtolower($Username) . '@example.com' ;

            $UserN = [
                'username' => $Username,
                'email'    => $Email == "" ? $Email2 : $Email,
                'password' => Hash::make($Username),
            ];

        }else{
            $UserN = [ 'email'            => strtolower(trim($this->email)), ];
        }
        $User = [
            'ap_paterno'       => strtoupper($this->ap_paterno),
            'ap_materno'       => strtoupper($this->ap_materno),
            'nombre'           => strtoupper($this->nombre),
            'curp'             => strtoupper($this->curp),
            'emails'           => $this->emails,
            'celulares'        => $this->celulares,
            'telefonos'        => $this->telefonos,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'genero'           => $this->genero,
        ];

        $User_Adress = [
            'calle'     => strtoupper($this->calle),
            'num_ext'   => $this->num_ext,
            'num_int'   => $this->num_int,
            'colonia'   => strtoupper($this->colonia),
            'localidad' => strtoupper($this->localidad),
            'municipio' => strtoupper($this->municipio),
            'estado'    => strtoupper($this->estado),
            'pais'      => strtoupper($this->pais),
            'cp'        => $this->cp,
        ];

        $User_Data_Extend = [
            'lugar_nacimiento' => strtoupper($this->lugar_nacimiento),
            'ocupacion'        => strtoupper($this->ocupacion),
            'profesion'        => strtoupper($this->profesion),
        ];
        try {

            if ($this->id == 0) {
                $user = User::create($UserN);
                $user->update($User);
                $role_invitado = Role::findByName('Invitado');
                $user->roles()->attach($role_invitado);
                $role_ciudadano = Role::findByName('CIUDADANO');
                $user->roles()->attach($role_ciudadano);
                $P1 = Permission::findByName('consultar');
                $user->permissions()->attach($P1);
                $user->user_adress()->create();
                $user->user_data_extend()->create();
                $F = new FuncionesController();
                $F->validImage($user, 'profile', 'profile/');

                $user->user_adress()->create($User_Adress);
                $user->user_data_extend()->create($User_Data_Extend);
            } else {
                $user = User::find($this->id);
                $user->update($User);
                $user->update($UserN);

                $user->user_adress()->update($User_Adress);
                $user->user_data_extend()->update($User_Data_Extend);
            }
        }catch (QueryException $e){
            $Msg = new MessageAlertClass();
            return $Msg->Message($e);
        }
        return $user;
    }

    protected function validPhoto(User $user){
        $F = new FuncionesController();
        $F->validImage($user,'profile','profile/');

    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newUser');
        }
    }

}
