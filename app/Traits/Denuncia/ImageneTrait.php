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
//        $exists = Storage::disk($this->disk)->exists($this->image);
        $file = "/storage/".$this->disk."/".$this->image;
        $exists = file_exists($file);
        $ret = $exists
            ? $file
            : '/images/web/file-not-found.png';
        return $ret;
    }

   // Get Image Thumbnail
    public function getPathImageThumbAttribute(){
        $fl   = explode('.',$this->image);
        $dg   = $fl[count($fl)-1];
        $flDoc = config("atemun.document_type_extension");
        $flImg = config("atemun.images_type_extension");
//        $rt   = in_array( $dg, $envi ) ? '/images/web/document-file.png': '/images/web/file-not-found.png';
        if ( in_array( $dg, $flDoc ) ) {
            $rt = '/images/web/document-file.png';
        }elseif (in_array( $dg, $flImg ) ) {
//            $rt =  "/storage/".$this->disk."/".$this->image_thumb;
//            $exists = Storage::disk($this->disk)->exists($this->image);
            $file = "/storage/".$this->disk."/".$this->image;
            $exists = file_exists($file);
            $rt = $exists
                ? $file
                : '/images/web/file-not-found.png';
        }else{
            $rt = '/images/web/file-not-found.png';
        }

        return $rt;

    }



}
