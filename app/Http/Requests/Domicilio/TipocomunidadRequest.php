<?php

namespace App\Http\Requests\Domicilio;

use App\Models\Catalogos\Domicilios\Tipocomunidad;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class TipocomunidadRequest extends FormRequest
{


    protected $redirectRoute = 'editTipocomunidad';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipocomunidad' => ['required','min:2',new Uppercase(),'unique:tipocomunidades,tipocomunidad,'.$this->id],
        ];
    }

    public function manage()
    {
        $Item = [
            'tipocomunidad' => strtoupper($this->tipocomunidad),
        ];

        try {
            if ($this->id == 0) {
                $item = Tipocomunidad::create($Item);
            } else {
                $item = Tipocomunidad::find($this->id);
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
            return $url->route('newTipocomunidad');
        }
    }




}
