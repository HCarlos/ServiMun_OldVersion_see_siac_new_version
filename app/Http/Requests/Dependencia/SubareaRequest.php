<?php

namespace App\Http\Requests\Dependencia;

use App\Models\Catalogos\Subarea;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class SubareaRequest extends FormRequest
{


    protected $redirectRoute = 'editSubarea';

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
            'subarea' => ['required','min:2'],
        ];
    }

    public function messages()
    {
        return [
            'subarea.required' => 'La :attribute requiere por lo menos de 2 caracteres',
        ];
    }

    public function attributes()
    {
        return [
            'subarea' => 'Subarea',
        ];
    }

    public function manage()
    {

        $Item = [
            'subarea' => strtoupper($this->subarea),
            'area_id' => $this->area_id,
            'jefe_id' => $this->jefe_id,
        ];

        try {

            if ($this->id == 0) {
                $item = Subarea::create($Item);

            } else {
                $item = Subarea::find($this->id);
                $item->update($Item);
            }
        }catch (QueryException $e){
            $Msg = new MessageAlertClass();
//            dd($Msg->Message($e));
            return $Msg->Message($e);
        }
//        dd($item);
        return $item;
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newSubarea');
        }
    }

    
    
}
