<?php

namespace App\Http\Requests;

use App\Models\Catalogos\Origen;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class OrigenRequest extends FormRequest
{


    protected $redirectRoute = 'editOrigen';

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
            'origen' => ['required','min:2','unique:origenes,origen,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'origen.required' => 'El :attribute requiere por lo menos de 2 caracter',
            'origen.unique' => 'El :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'origen' => 'Origen',
        ];
    }

    public function manage()
    {

        $Item = [
            'origen' => strtoupper($this->origen),
        ];

        try {

            if ($this->id == 0) {
                $item = Origen::create($Item);
            } else {
                $item = Origen::find($this->id);
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
            return $url->route('newOrigen');
        }
    }    
    
    
    
}
