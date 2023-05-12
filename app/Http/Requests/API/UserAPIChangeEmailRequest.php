<?php

namespace App\Http\Requests\API;

use App\Rules\CurrentPassword;
use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UserAPIChangeEmailRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
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
            'nuevo_correo' => ['required','confirmed','min:5'],
        ];
    }
//'correo_actual' => ['required','min:5',new CurrentPassword()],

    public function messages()
    {
        return [
            'correo_actual.required' => 'Se requiere el :attribute.',
            'correo_actual.min' => 'El :attribute debe ser por lo menos de 5 caracteres.',
            'correo_actual.current_password' => 'El :attribute no es correcto.',
            'nuevo_correo.required' => 'Se requiere el :attribute.',
            'nuevo_correo.min' => ':attribute debe ser por lo menos de 5 caracteres.',
            'nuevo_correo.confirmed' => 'La confirmación del password no coincide con el nuevo password.',
        ];
    }

    public function attributes()
    {
        return [
            'correo_actual' => 'Correo Actual',
            'nuevo_correo' => 'Correo',
            'correo_confirmation' => 'Confirmar Correo',
        ];
    }

    public function sanitize()
    {
        return $this->only('nuevo_correo');
    }


    public function manage()
    {
        try {
            app()['cache']->forget('spatie.permission.cache');
            $user = User::find($this->user_id);
            $user->email = $this->nuevo_correo;
            $user->save();
            $user->sendEmailVerificationNotification();
        } catch (QueryException $e) {
            return ["status"=>0, "msg"=>$e->getMessage()];
        }
        return $user;
    }


    public function failedValidation(Validator $validator){
        $err = "";
        foreach ($validator->errors()->getMessages() as $ss){
            $err .= $err == "" ?  $ss[0] : " :: ". $ss[0];
        }
        throw new HttpResponseException(response()->json([
            'status' => 0,
            'msg'    => $err,
        ]));
    }


}
