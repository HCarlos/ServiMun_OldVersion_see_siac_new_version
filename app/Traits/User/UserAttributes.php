<?php
/**
 * Created by PhpStorm.
 * Users: devch
 * Date: 21/11/18
 * Time: 10:16 AM
 */
namespace App\Traits\User;


trait UserAttributes
{

    public function getRoleIdStrArrayAttribute(){
        return $this->roles()->allRelatedIds('id')->implode('|','id');
    }

    public function getRoleNameStrArrayAttribute(){
        return $this->roles()->pluck('name')->implode('|','name');
    }

    public function getFullNameAttribute() {
//        return "{$this->ap_paterno} {$this->ap_materno} {$this->nombre}";
        return trim($this->ap_paterno).' '.trim($this->ap_materno).' '.trim($this->nombre);
    }

    public function getStrGeneroAttribute() {
        $Gen = "Desconocido";
        switch ($this->genero){
            case 0:
                $Gen = "FEMENINO";
                break;
            case 1:
                $Gen = "MASCULINO";
                break;
        }
        return $Gen;
    }


}
