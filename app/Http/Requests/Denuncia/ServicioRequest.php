<?php

namespace App\Http\Requests\Denuncia;

use App\Models\Catalogos\Servicio;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class ServicioRequest extends FormRequest
{


    protected $redirectRoute = 'editServicio';

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
            'servicio' => ['required','min:2',new Uppercase,'unique:servicios,servicio,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'servicio.required' => 'La :attribute requiere por lo menos de 2 caracteres',
            'servicio.unique' => 'La :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'servicio' => 'Servicio',
        ];
    }

    public function manage()
    {

        $Item = [
            'servicio' => strtoupper($this->servicio),
            'class_css' => $this->class_css,
            'habilitado' => $this->habilitado==1?true:false,
            'medida_id' => $this->medida_id,
            'subarea_id' => $this->subarea_id,
        ];

        try {
            if ($this->id == 0) {
                $item = Servicio::create($Item);
                $item->subareas()->attach($this->subarea_id);
            } else {
                $item = Servicio::find($this->id);
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
            return $url->route('newServicio');
        }
    }
    
    

}
