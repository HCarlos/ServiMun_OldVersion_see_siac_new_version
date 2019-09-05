<?php

namespace App\Http\Requests\Denuncia;

use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Denuncias\Denuncia;
use App\Models\Denuncias\DenunciaEstatu;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DenunciaRequest extends FormRequest
{


    protected $redirectRoute = 'editDenuncia';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'descripcion'      => ['required'],
            'referencia'       => ['required'],
            'fecha_ingreso'    => ['required','date'],
            'fecha_limite'     => ['required','date'],
            'fecha_ejecucion'  => ['required','date'],
            'prioridad_id'     => ['required'],
            'origen_id'        => ['required'],
            'dependencia_id'   => ['required'],
            'servicio_id'      => ['required'],
            'ciudadano_id'     => ['required'],
            'ubicacion_id'     => ['required','numeric','min:1'],
            'estatus_id'       => ['required'],
        ];
    }


    public function manage()
    {
        //dd($this->all());
        try {

            $Ubicacion = Ubicacion::findOrFail($this->ubicacion_id);

            $fechaActual    = Carbon::now();
            $fechaLimite    = Carbon::now();
            $fechaEjecucion = Carbon::now();

            $Item = [
                'fecha_ingreso'            => $fechaActual,
                'oficio_envio'             => strtoupper($this->oficio_envio),
                'fecha_oficio_dependencia' => $this->fecha_oficio_dependencia,
                'fecha_limite'             => $fechaLimite->addDays(5),
                'fecha_ejecucion'          => $fechaEjecucion->addDays(3),

                'descripcion'              => strtoupper($this->descripcion),
                'referencia'               => strtoupper($this->referencia),

                'calle'                    => strtoupper($Ubicacion->calle),
                'num_ext'                  => strtoupper($Ubicacion->num_ext),
                'num_int'                  => strtoupper($Ubicacion->num_int),
                'colonia'                  => strtoupper($Ubicacion->colonia),
                'comunidad'                => strtoupper($Ubicacion->comunidad),
                'ciudad'                   => strtoupper($Ubicacion->ciudad),
                'municipio'                => strtoupper($Ubicacion->municipio),
                'estado'                   => strtoupper($Ubicacion->estado),
                'cp'                       => strtoupper($Ubicacion->cp),

                'latitud'                  => $this->latitud,
                'longitud'                 => $this->longitud,

                'prioridad_id'             => $this->prioridad_id,
                'origen_id'                => $this->origen_id,
                'dependencia_id'           => $this->dependencia_id,
                'ubicacion_id'             => $this->ubicacion_id,
                'servicio_id'              => $this->servicio_id,
                'estatus_id'               => $this->estatus_id,
                'ciudadano_id'             => $this->ciudadano_id,
                'creadopor_id'             => $this->creadopor_id,
                'modificadopor_id'         => $this->modificadopor_id,

            ];

            if ($this->id == 0) {
                $item = Denuncia::create($Item);
            } else {
                $item = Denuncia::find($this->id);
                $this->detaches($item);
                $item->update($Item);
            }
            $this->attaches($item);
        }catch (QueryException $e){
            $Msg = new MessageAlertClass();
            return $Msg->Message($e);
        }
        return $item;

    }

    public function attaches($Item){
        $Item->prioridades()->attach($this->prioridad_id);
        $Item->origenes()->attach($this->origen_id);
        $Item->dependencias()->attach($this->dependencia_id,['servicio_id'=>$this->servicio_id,'estatu_id'=>$this->estatus_id,'fecha_movimiento' => now() ]);
        $Item->ubicaciones()->attach($this->ubicacion_id);
        $Item->servicios()->attach($this->servicio_id);

//        DenunciaEstatu::where('denuncia_id',$this->id)->update(['ultimo'=>false]);
        $Item->estatus()->attach($this->estatus_id,['ultimo'=>true]);
        $Item->ciudadanos()->attach($this->ciudadano_id);
        $Item->creadospor()->attach($this->creadopor_id);
        $Item->modificadospor()->attach($this->modificadopor_id);
        return $Item;
    }

    public function detaches($Item){
        $Item->prioridades()->detach($this->prioridad_id);
        $Item->origenes()->detach($this->origen_id);
        $Item->dependencias()->detach($this->dependencia_id);
        $Item->ubicaciones()->detach($this->ubicacion_id);
        $Item->servicios()->detach($this->servicio_id);

        $Item->estatus()->detach($this->estatus_id);
        DenunciaEstatu::where('denuncia_id',$this->id)->orderByDesc('id')->update(['ultimo'=>true]);
        $Item->ciudadanos()->detach($this->ciudadano_id);
        $Item->creadospor()->detach($this->creadopor_id);
        $Item->modificadospor()->detach($this->modificadopor_id);
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
