<?php

namespace App\Http\Requests\Domicilio;

use App\Models\Catalogos\Domicilios\Comunidad;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class ComunidadRequest extends FormRequest
{


    protected $redirectRoute = 'editComunidad';

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
            'comunidad'        => ['required','min:2',new Uppercase,'unique:comunidades,comunidad,'.$this->id],
            'delegado_id'      => ['required','min:1','unique:comunidades,delegado_id,'.$this->id],
            'tipocomunidad_id' => ['required','min:1'],
        ];
    }
    
    public function manage()
    {

        $Item = [
            'comunidad' => strtoupper($this->comunidad),
            'tipocomunidad_id' => $this->tipocomunidad_id,
            'delegado_id' => $this->delegado_id,
        ];

        try {

            if ($this->id == 0) {
                $item = Comunidad::create($Item);
            } else {
                $item = Comunidad::find($this->id);
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
            return $url->route('newComunidad');
        }
    }



}
