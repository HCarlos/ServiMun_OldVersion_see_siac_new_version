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
        $path = config('atemun.public_url');
        $root = trim($this->root) == "" || trim($this->root) == "NULL" || is_null($this->root) ? $path : $this->root;

        $exists = Storage::disk($this->disk)->exists($this->image);
        $file = $root."/storage/".$this->disk."/".$this->image;
//        $exists = file_exists($file);
        $ret = $exists
            ? $file
            : $root.'/images/web/file-not-found.png';
        return $ret;
    }

    public function getPathImageThumbAttribute(){
        $path = config('atemun.public_url');
        $root = trim($this->root) == "" || trim($this->root) == "NULL" || is_null($this->root) ? $path : $this->root;

        $fl   = explode('.',$this->image);
        $dg   = $fl[count($fl)-1];
        $flDoc = config("atemun.document_type_extension");
        $flImg = config("atemun.images_type_extension");
        if ( in_array( $dg, $flDoc ) ) {
            $rt = $root.'/images/web/document-file.png';
        }elseif (in_array( $dg, $flImg ) ) {
            $exists = Storage::disk($this->disk)->exists($this->image);
            $file = $root."/storage/".$this->disk."/".$this->image;
            $rt = $exists
                ? $file
                : $root.'/images/web/file-not-found.png';
        }else{
            $rt = $root.'/images/web/file-not-found.png';
        }

        return $rt;

    }



}
