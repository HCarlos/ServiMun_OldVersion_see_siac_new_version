<?php
/**
 * Created by PhpStorm.
 * Users: devch
 * Date: 21/11/18
 * Time: 10:16 AM
 */
namespace App\Traits\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait UserAttributes
{

    protected $disk1 = 'profile';

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

    public function getTipoImageProfile($tipo=""){
        switch ($tipo){
            case 'thumb':
                return $this->filename_thumb;
                break;
            case 'png':
                return $this->filename_png;
                break;
            default :
                return $this->filename;
                break;
        }
    }

    // Get Image
    public function getPathImageProfileAttribute(){
        $ret = 'images/web/file-not-found.png';
        if ( $this->IsEmptyPhoto() ){
            if ( $this->IsFemale() ){
                $ret = 'images/web/empty_user_female.png';
            }else{
                $ret = 'images/web/empty_user_male.png';
            }
        }else{
            $tFile = $this->getTipoImageProfile("");
            $exists = Storage::disk($this->disk1)->exists($tFile);
            $ret = $exists
                ? "storage/".$this->disk1."/".$tFile
                : $ret;
        }
        return $ret;
    }

    // Get Image Thumbnail
    public function getPathImageThumbProfileAttribute(){
        $ret = '/images/web/file-not-found.png';
        if ( $this->IsEmptyPhoto() ){
            if ( $this->IsFemale() ){
                $ret = '/images/web/empty_user_female.png';
            }else{
                $ret = '/images/web/empty_user_male.png';
            }
        }else{
            $tFile = $this->getTipoImageProfile("thumb");
            $exists = Storage::disk($this->disk1)->exists($tFile);
            $ret = $exists
                ? "/storage/".$this->disk1."/".$tFile
                : $ret;
        }
        return $ret;
    }


}
