<?php

namespace App\Http\Requests\Domicilio;

use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Localidad;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Rules\UbicacionUnica;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class UbicacionRequest extends FormRequest
{


    protected $redirectRoute = 'editUbicacion';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'num_ext'         => ['required'],
            'num_int'         => ['present'],
            'calle_id'        => ['required'],
            'calle_id'        => ['required'],
            'colonia_id'      => ['required'],
            'localidad_id'    => ['required'],
            'ciudad_id'       => ['required'],
            'municipio_id'    => ['required'],
            'estado_id'       => ['required'],
            'codigopostal_id' => ['required'],
            'latitud'         => ['present'],
            'longitud'        => ['present'],
            'longitud'              => [
                                    Rule::unique('ubicaciones')
                                        ->where('calle_id', $this->calle_id)
                                        ->where('colonia_id', $this->colonia_id)
                                        ->where('localidad_id', $this->localidad_id)
                                        ->where('ciudad_id', $this->ciudad_id)
                                        ->where('municipio_id', $this->municipio_id)
                                        ->where('estado_id', $this->estado_id),
                                 ]

            ];

    }

    public function manage()
    {

        try {

            $Calle   = Calle::findOrFail($this->calle_id);
            $Colonia = Colonia::findOrFail($this->colonia_id);
            $Localidad = Localidad::findOrFail($this->localidad_id);
            $Ciudad = Ciudad::findOrFail($this->ciudad_id);
            $Municipio = Municipio::findOrFail($this->municipio_id);
            $Estado = Estado::findOrFail($this->estado_id);
            $CPs = Codigopostal::findOrFail($this->codigopostal_id);
            $Item = [
                'calle' => strtoupper($Calle->calle),
                'num_ext' => strtoupper($this->num_ext),
                'num_int' => strtoupper($this->num_int),
                'colonia' => strtoupper($Colonia->colonia),
                'localidad' => strtoupper($Localidad->localidad),
                'ciudad' => strtoupper($Ciudad->ciudad),
                'municipio' => strtoupper($Municipio->municipio),
                'estado' => strtoupper($Estado->estado),
                'cp' => strtoupper($CPs->cp),
                'latitud' => $this->latitud,
                'longitud' => $this->longitud,
                'calle_id' => $this->calle_id,
                'colonia_id' => $this->colonia_id,
                'localidad_id' => $this->localidad_id,
                'ciudad_id' => $this->ciudad_id,
                'municipio_id' => $this->municipio_id,
                'estado_id' => $this->estado_id,
                'codigopostal_id' => $this->codigopostal_id,

            ];


            if ($this->id == 0) {
                $item = Ubicacion::create($Item);
            } else {
                $item = Ubicacion::find($this->id);
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
        $Item->calles()->attach($this->calle_id);
        $Item->colonias()->attach($this->colonia_id);
        $Item->localidades()->attach($this->localidad_id);
        $Item->ciudades()->attach($this->ciudad_id);
        $Item->municipios()->attach($this->municipio_id);
        $Item->estados()->attach($this->estado_id);
        $Item->codigospostales()->attach($this->codigopostal_id);
        return $Item;
    }

    public function detaches($Item){
        $Item->calles()->detach($Item->calle_id);
        $Item->colonias()->detach($Item->colonia_id);
        $Item->localidades()->detach($Item->localidad_id);
        $Item->ciudades()->detach($Item->ciudad_id);
        $Item->municipios()->detach($Item->municipio_id);
        $Item->estados()->detach($Item->estado_id);
        $Item->codigospostales()->detach($Item->codigopostal_id);
        return $Item;
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newUbicacion');
        }
    }





}
