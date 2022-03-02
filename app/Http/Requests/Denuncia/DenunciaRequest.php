<?php

namespace App\Http\Requests\Denuncia;

use App\Http\Controllers\Storage\StorageDenunciaController;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Denuncias\Denuncia;
use App\Models\Denuncias\DenunciaEstatu;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DenunciaRequest extends FormRequest
{


    protected $redirectRoute = 'editDenuncia';

    public function validationData(){
        $attributes = parent::all();
        $IsEnlace =Auth::user()->isRole('ENLACE');
        $DependenciaArray = '';
        IF ($IsEnlace) {
            $DependenciaIdArray = Auth::user()->DependenciaIdArray;
            $attributes['dependencia_id'] = $DependenciaIdArray;
        }
        $this->replace($attributes);
        return parent::all();
    }


    public function authorize(){
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
            'usuario_id'       => ['required'],
            'ubicacion_id'     => ['required','numeric','min:1'],
            'estatus_id'       => ['required'],
        ];
    }

    public function messages(){
        return [
            'descripcion.required'   => 'La :attribute requiere por lo menos de 4 caracter',
            'referencia.required'    => 'La :attribute es requerida',
            'fecha_ingreso.required' => 'La :attribute es requerida',
        ];
    }

    public function attributes(){
        return [
            'descripcion'     => 'Denuncia',
            'referencia'      => 'Referencia',
            'fecha_ingreso'   => 'Fecha de Ingreso',
            'fecha_limite'    => 'Fecha Límite',
            'fecha_ejecucion' => 'Fecha de Ejecución',
            'prioridad_id'    => 'Prioridad',
            'origen_id'       => 'Origen',
            'dependencia_id'  => 'Dependencia',
            'servicio_id'     => 'Servicio',
            'usuario_id'      => 'Usuario',
            'ubicacion_id'    => 'Ubicación',
        ];
    }

    public function manage(){
        try {
            $Ubicacion = Ubicacion::findOrFail($this->ubicacion_id);

            $Item = [
                'fecha_ingreso'                => Carbon::now(), //Carbon::now($this->fecha_ingreso)->format('Y-m-d hh:mm:ss'),
                'oficio_envio'                 => is_null($this->oficio_envio) ? "" : strtoupper($this->oficio_envio),
                'folio_sas'                    => is_null($this->folio_sas) ? "" : strtoupper($this->folio_sas),
                'fecha_oficio_dependencia'     => $this->fecha_oficio_dependencia,
                'fecha_limite'                 => $this->fecha_limite,
                'fecha_ejecucion'              => $this->fecha_ejecucion,
                'descripcion'                  => strtoupper($this->descripcion),
                'referencia'                   => strtoupper($this->referencia),
                'calle'                        => strtoupper($Ubicacion->calle),
                'num_ext'                      => strtoupper($Ubicacion->num_ext),
                'num_int'                      => strtoupper($Ubicacion->num_int),
                'colonia'                      => strtoupper($Ubicacion->colonia),
                'comunidad'                    => strtoupper($Ubicacion->comunidad),
                'ciudad'                       => strtoupper($Ubicacion->ciudad),
                'municipio'                    => strtoupper($Ubicacion->municipio),
                'estado'                       => strtoupper($Ubicacion->estado),
                'cp'                           => strtoupper($Ubicacion->cp),

                'latitud'                      => $this->latitud ?? 0.0000,
                'longitud'                     => $this->longitud ?? 0.0000,

                'prioridad_id'                 => $this->prioridad_id,
                'origen_id'                    => $this->origen_id,
                'dependencia_id'               => $this->dependencia_id,
                'ubicacion_id'                 => $this->ubicacion_id,
                'servicio_id'                  => $this->servicio_id,
                'estatus_id'                   => $this->estatus_id,
                'ciudadano_id'                 => $this->usuario_id,
                'creadopor_id'                 => $this->creadopor_id,
                'modificadopor_id'             => $this->modificadopor_id,
                'domicilio_ciudadano_internet' => strtoupper(trim($this->domicilio_ciudadano_internet))  ?? '' ,
                'observaciones'                => strtoupper(trim($this->observaciones)),

            ];
            //dd($Item);
            if (Auth::user()->isRole('Administrator|SysOp|USER_OPERATOR_SIAC|USER_OPERATOR_ADMIN')){
                $item = $this->guardar($Item);
            }elseif ( Auth::user()->isRole('USER_SAS_SIAC|USER_SAS_ADMIN') && Auth::user()->id == $this->creadopor_id ){
                $item = $this->guardar($Item);
            }else{
                return null;
            }

        }catch (QueryException $e){
            $Msg = new MessageAlertClass();
            throw new HttpResponseException(response()->json( $Msg->Message($e), 422));
        }
        return $item;

    }

    protected function guardar($Item){
        if ($this->id == 0) {
            $item = Denuncia::create($Item);
        } else {
            $item = Denuncia::find($this->id);
            if ($item->cerrado == false){
                $this->detaches($item);
                $item->update($Item);
            }
        }
        if ($item->cerrado == false) {
            $this->attaches($item);
            $Storage = new StorageDenunciaController();
            $Storage->subirArchivoDenuncia($this, $item);
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
        $Item->ciudadanos()->attach($this->usuario_id);
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
        $Item->ciudadanos()->detach($this->usuario_id);
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
