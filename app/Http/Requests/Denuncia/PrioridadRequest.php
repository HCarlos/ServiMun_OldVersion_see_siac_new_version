<?php

namespace App\Http\Requests\Denuncia;

use App\Models\Catalogos\Prioridad;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class PrioridadRequest extends FormRequest
{


    protected $redirectRoute = 'editPrioridad';

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
            'prioridad' => ['required','min:2',new Uppercase,'unique:prioridades,prioridad,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'prioridad.required' => 'La :attribute requiere por lo menos de 2 caracteres',
            'prioridad.unique' => 'La :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'prioridad' => 'Prioridad',
        ];
    }

    public function manage()
    {

        $Item = [
            'prioridad' => strtoupper($this->prioridad),
            'class_css' => $this->class_css,
            'predeterminado' => $this->predeterminado==1?true:false,
        ];

        try {
            if ($this->predeterminado==1) {
                $items = Prioridad::where("predeterminado",true);
                $items->update(["predeterminado" => false]);
            }
            if ($this->id == 0) {
                $item = Prioridad::create($Item);
            } else {
                $item = Prioridad::find($this->id);
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
            return $url->route('newPrioridad');
        }
    }




}
