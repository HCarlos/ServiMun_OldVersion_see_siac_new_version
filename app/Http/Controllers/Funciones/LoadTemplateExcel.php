<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 21/11/18
 * Time: 06:38 PM
 */

namespace App\Http\Controllers\Funciones;

use Illuminate\Support\Facades\Storage;

class LoadTemplateExcel
{

    public static function getFileInicio($extension){
        return storage_path('externo') . '/inicio.' . $extension;
    }

    public static function getFileExistencias($extension){
        return storage_path('app/public/externo') . '/base.' . $extension;
    }

    public static function getFileTemplate($file){
        return env('EXTERNO_ROOT_LOCAL') . $file;
    }

    public static function getDirFormatUser($extension){
        return storage_path('app/public/externo') . '/base.' . $extension;
    }

    public static function getFileInventario($extension){
        return storage_path('externo') . '/inventario.' . $extension;
    }

    public static function getFileCompra($extension){
        return storage_path('externo') . '/compra.' . $extension;
    }

}
