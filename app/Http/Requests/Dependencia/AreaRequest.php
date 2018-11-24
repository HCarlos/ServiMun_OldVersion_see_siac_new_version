<?php

namespace App\Http\Requests\Dependencia;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Catalogos\Area;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class AreaRequest extends FormRequest
{

    protected $redirectRoute = 'editArea';

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
            'area' => ['required','min:2','unique:areas,area,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'area.required' => 'La :attribute requiere por lo menos de 2 caracteres',
            'area.unique' => 'La :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'area' => 'Area',
        ];
    }

    public function manage()
    {

        $Item = [
            'area' => strtoupper($this->area),
            'dependencia_id' => $this->dependencia_id,
            'jefe_id' => $this->jefe_id,
        ];

        try {

            if ($this->id == 0) {
                $item = Area::create($Item);

            } else {
                $item = Area::find($this->id);
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
            return $url->route('newArea');
        }
    }


}
