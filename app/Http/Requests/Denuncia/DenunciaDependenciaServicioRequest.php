<?php

namespace App\Http\Requests\Denuncia;

use App\Classes\MessageAlertClass;
use App\Models\Denuncias\Denuncia;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;

class DenunciaDependenciaServicioRequest extends FormRequest
{



    protected $redirectRoute = 'editDenuncia';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'dependencia_id' => ['required'],
            'servicio_id'    => ['required'],
            'estatus_id'     => ['required'],
        ];
    }


    public function manage()
    {
        //dd($this->all());
        try {

            $Item = [
                'dependencia_id' => $this->dependencia_id,
                'servicio_id'    => $this->servicio_id,
                'estatus_id'     => $this->estatus_id,
            ];
            $item = Denuncia::find($this->id);
            $this->attaches($item);
        }catch (QueryException $e){
            $Msg = new MessageAlertClass();
            return $Msg->Message($e);
        }
        return $item;

    }

    public function attaches($Item){
        $Item->dependencias()->attach($this->dependencia_id,['servicio_id'=>$this->servicio_id,'estatu_id'=>$this->estatus_id,'fecha_movimiento' => now() ]);
        return $Item;
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newDenuncia');
        }
    }











}
