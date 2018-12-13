<?php

namespace App\Http\Requests\Domicilio;

use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class CalleRequest extends FormRequest
{




    protected $redirectRoute = 'editCalle';

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
            'calle' => ['required','min:2',new Uppercase,'unique:calles,calle,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'calle.required' => 'El :attribute requiere por lo menos de 2 caracteres',
            'calle.unique' => 'La :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'calle' => 'Calle',
        ];
    }

    public function manage()
    {

        $Item = [
            'calle' => strtoupper($this->calle),
        ];

        try {
            if ($this->id == 0) {
                $item = Calle::create($Item);
            } else {
                $item = Calle::find($this->id);
                Ubicacion::detachesCalle($this->id);
                $item->update($Item);
                Ubicacion::attachesCalle($this->id);
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
            return $url->route('newCalle');
        }
    }








}
