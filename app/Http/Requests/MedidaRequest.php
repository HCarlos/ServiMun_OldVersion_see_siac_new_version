<?php

namespace App\Http\Requests;

use App\Models\Catalogos\Medida;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class MedidaRequest extends FormRequest
{


    protected $redirectRoute = 'editMedida';

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
            'medida' => ['required','min:2',new Uppercase,'unique:medidas,medida,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'medida.required' => 'El :attribute requiere por lo menos de 2 caracter',
            'medida.unique' => 'El :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'medida' => 'Medida',
        ];
    }

    public function manage()
    {

        $Item = [
            'medida' => strtoupper($this->medida),
        ];

        try {

            if ($this->id == 0) {
                $item = Medida::create($Item);
            } else {
                $item = Medida::find($this->id);
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
            return $url->route('newMedida');
        }
    }
    
    
    
    
}
