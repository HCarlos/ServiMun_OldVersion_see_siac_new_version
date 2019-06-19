<?php

namespace App\Http\Requests\Denuncia;

use App\Models\Catalogos\Estatu;
use App\Observers\Catalogos\Estatu\PostUpdating;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;

class StatuRequest extends FormRequest
{


    protected $redirectRoute = 'editEstatu';

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
            'estatus' => ['required','min:3',new Uppercase,'unique:estatus,estatus,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'estatus.required' => 'El :attribute requiere por lo menos de 3 caracter',
            'estatus.unique' => 'El :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'estatus' => 'Estatus',
        ];
    }

    public function manage()
    {

        $Item = [
            'estatus' => strtoupper($this->estatus),
            'predeterminado' => $this->predeterminado==1 ? true : false,
        ];

        try {
            if ( $this->predeterminado == 1) {
                Estatu::where('predeterminado',true)->update(['predeterminado'=>false]);
            };
//            return $query->whereHas('roles', function ($q) use ($roles) {
//                $q->whereIn('role_id', $roles);
//            });
            $idd = $this->dependencia_id;
            $isExsit = Estatu::whereHas('dependencias', function ($q) use ($idd) {
                return $q->where("dependencia_id",$idd);
            })->first();

//            dd($isExsit);
            if ($this->id == 0) {
                $item = Estatu::create($Item);
                if ($this->dependencia_id > 0 && $isExsit <= 0 ){
                    $item->dependencias()->attach($this->dependencia_id);
                }
            } else {
                $item = Estatu::find($this->id);
                $item->update($Item);
                if ($this->dependencia_id > 0 && $isExsit <= 0 ){
                    $item->dependencias()->attach($this->dependencia_id);
                    $observer = PostUpdating::updating($item);
                }
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
            return $url->route('newEstatu');
        }
    }


}
