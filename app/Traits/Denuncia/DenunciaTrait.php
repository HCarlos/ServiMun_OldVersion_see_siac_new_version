<?php
/**
 * Copyright (c) 2018. Realizado por Carlos Hidalgo
 */

/**
 * Created by PhpStorm.
 * User: devch
 * Date: 27/11/18
 * Time: 05:50 PM
 */

namespace App\Traits\Denuncia;


use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Comunidad;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\User;

trait DenunciaTrait
{

    public function getFullUbicationAttribute(){
        return $this->calle.' '.
            $this->num_ext.' '.
            $this->num_int.' '.
            $this->colonia.' '.
            $this->comunidad.' '.
            $this->ciudad.' '.
            $this->municipio.' '.
            $this->estado.' '.
            $this->cp;
    }

    public function getFechaIngresoSolicitudAttribute(){
        return  $this->fecha_ingreso->format('d-m-Y H:i:s');;
    }

    public function getFolioDacAttribute(){
        return "DAC-".str_pad($this->id,6,'0',STR_PAD_LEFT)."-".$this->fecha_ingreso->format('y');
    }

}
