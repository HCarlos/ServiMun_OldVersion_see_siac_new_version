<?php

namespace App\Http\Requests\Domicilio;

use App\Models\Catalogos\Domicilios\Tipoasentamiento;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class TipoasentamientoRequest extends FormRequest
{


    protected $redirectRoute = 'editTipoasentamiento';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipoasentamiento' => ['required','min:2',new Uppercase(),'unique:tipoasentamientos,tipoasentamiento,'.$this->id],
        ];
    }

    public function manage()
    {
        $Item = [
            'tipoasentamiento' => strtoupper($this->tipoasentamiento),
        ];

        try {
            if ($this->id == 0) {
                $item = Tipoasentamiento::create($Item);
            } else {
                $item = Tipoasentamiento::find($this->id);
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
            return $url->route('newTipoasentamiento');
        }
    }






}
