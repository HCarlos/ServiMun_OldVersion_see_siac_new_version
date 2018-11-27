<?php

namespace App\Http\Requests\Domicilio;

use App\Models\Catalogos\Domicilios\Localidad;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class LocalidadRequest extends FormRequest
{


    protected $redirectRoute = 'editLocalidad';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'localidad' => ['required','min:2',new Uppercase,'unique:localidades,localidad,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'localidad.required' => 'El :attribute requiere por lo menos de 2 caracteres',
            'localidad.unique' => 'La :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'localidad' => 'Localidad',
        ];
    }

    public function manage()
    {

        $Item = [
            'localidad' => strtoupper($this->localidad),
        ];

        try {
            if ($this->id == 0) {
                $item = Localidad::create($Item);
            } else {
                $item = Localidad::find($this->id);
                $item->update($Item);
            }
        }catch (QueryException $e){
            $Msg = new MessageAlertClass();
            return $Msg->Message($e);
        }
        return $item;
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newLocalidad');
        }
    }






}
