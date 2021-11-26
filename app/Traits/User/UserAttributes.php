<?php
/**
 * Created by PhpStorm.
 * Users: devch
 * Date: 21/11/18
 * Time: 10:16 AM
 */
namespace App\Traits\User;


use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait UserAttributes
{

    protected $disk1 = 'profile';

    public function isRole($role): bool{
        return $this->hasRole($role);
    }

    public function getRoleIdStrArrayAttribute(){
        return $this->roles()->allRelatedIds('id')->implode('|','id');
    }

    public function getRoleNameStrArrayAttribute(){
        return $this->roles()->pluck('name')->implode('|','name');
    }

    public function hasDependencia($dependencia): bool{
        return $this->dependencias->contains('id',$dependencia);
    }

    public function getDependenciaArrayAttribute(){
        return $this->dependencias()->pluck('dependencia')->implode('|','name');
    }

    public function getDependenciaIdArrayAttribute(){
        return $this->dependencias()->pluck('dependencia_id')->implode('|','name');
    }

    public function getFullNameAttribute() {
        return "{$this->ap_paterno} {$this->ap_materno} {$this->nombre}";
//        return trim($this->ap_paterno).' '.trim($this->ap_materno).' '.trim($this->nombre);
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
        return $this->getImage("");
    }

    // Get Image Thumbnail
    public function getPathImageThumbProfileAttribute(){
        return $this->getImage("thumb");
    }

    // Get Image PNG
    public function getPathImagePNGProfileAttribute(){
        return $this->getImage("png");
    }

    public function getImage($tipoImage="thumb"){
        $ret = '/images/web/file-not-found.png';
        if ( $this->IsEmptyPhoto() ){
            if ( $this->IsFemale() ){
                $ret = '/images/web/empty_user_female.png';
            }else{
                $ret = '/images/web/empty_user_male.png';
            }
        }else{
            $tFile = $this->getTipoImageProfile($tipoImage);
            $exists = Storage::disk($this->disk1)->exists($tFile);
            $ret = $exists
                ? "/storage/".$this->disk1."/".$tFile
                : $ret;
        }
        return $ret;

    }

    public function getHomeAttribute($withSlash=false): string {

        $slash = "/";
        if (Auth::user()->isRole('Administrator|SysOp')){
            $home = 'home';
        }  elseif (Auth::user()->isRole('DELEGADO|CIUDADANO')) {
            $home = 'home-ciudadano';
        } else {
            $home = 'home';
        }
        return $withSlash ? $slash . $home : $home;
    }

    public static function getUsernameNext( string $Abreviatura ): array{
        $Abreviatura = $Abreviatura == "0" ? "inv" : $Abreviatura;
        $next_id=DB::select("SELECT NEXTVAL('users_id_seq')");
        $Id = intval($next_id['0']->nextval);
        DB::select("SELECT SETVAL('users_id_seq',".($Id-1).")" );
        $Id = str_pad($Id,6,'0',0);
        $role = Role::query()->where('abreviatura',$Abreviatura)->first();
        return ['username'=>$role->abreviatura.$Id,'role_id'=>$role->id];
    }

    public function getTelefonosCelularesEmailsAttribute(){
        return "{$this->celulares}; {$this->telefonos}; {$this->emails}";
    }



}
