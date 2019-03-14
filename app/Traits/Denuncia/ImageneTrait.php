<?php
/**
 * Copyright (c) 2019. Realizado por Carlos Hidalgo
 */

/**
 * Created by PhpStorm.
 * User: devch
 * Date: 14/03/19
 * Time: 11:51 AM
 */

namespace App\Traits\Denuncia;


use Illuminate\Support\Facades\Storage;

trait ImageneTrait
{
    protected $disk = 'denuncia';

    // Get Image
    public function getPathImageAttribute(){
        $exists = Storage::disk($this->disk)->exists($this->image);
        $ret = $exists
            ? "/storage/".$this->disk."/".$this->image
            : '/images/web/file-not-found.png';
        return $ret;
    }

   // Get Image Thumbnail
    public function getPathImageThumbAttribute(){
        $fl  = explode('.',$this->image_thumb);
        $dg  = $fl[count($fl)-1];
        $envi = config("atemun.videos_type_extension");
        $rt  =in_array( $dg, $envi ) ? '/images/web/video-icon.png':'/images/web/file-not-found.png';

        $exists = Storage::disk($this->disk)->exists($this->image_thumb);
        $ret = $exists
            ? "/storage/".$this->disk."/".$this->image_thumb
            : $rt;
        return $ret;
    }



}
