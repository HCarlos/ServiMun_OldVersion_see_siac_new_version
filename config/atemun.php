<?php
/**
 * Created by PhpStorm.
 * Users: devch
 * Date: 21/11/18
 * Time: 09:19 AM
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Tipos de archivo
    |--------------------------------------------------------------------------
    */

    'images_type_validate' => 'jpg,jpeg,gif,png,JPG,JPEG,GIF,PNG',
    'images_type_extension' => ['jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'],
    'excel_type_extension' => ['xlsx','xls'],

    // -----------------------------------------------------------
    // Aqui se deben configurar los formatos a utilizar.
    // -----------------------------------------------------------

    'archivos'=>[
        'fmt_lista_usuarios'           => 'fmt_lista_usuarios.xlsx',
        'fmt_lista_niveles'            => 'fmt_lista_niveles.xlsx',
        'fmt_lista_parentescos'        => 'fmt_lista_parentescos.xlsx',
        'fmt_lista_familias'           => 'fmt_lista_familias.xlsx',
        'fmt_lista_registros_fiscales' => 'fmt_lista_registros_fiscales.xlsx',
    ],

    // -----------------------------------------------------------
    // La mayor parte de los Tablas estan configuradas aquí,
    // es en este mismo sitio donde la debes mantener forerver
    // -----------------------------------------------------------

    'table_names' => [
        'users' => [
            'users'       => 'users',
            'roles'       => 'roles',
            'permissions' => 'permissions',
            'user_adress' => 'user_adress',
            'user_extend' => 'user_extend',
            'user_becas'  => 'user_becas',
        ],
        'catalogos' => [
            'ciclos'             => 'ciclos',
            'niveles'            => 'niveles',
            'registros_fiscales' => 'registros_fiscales',
        ],
        'familias' => [
            'familias'                  => 'familias',
            'parentescos'               => 'parentescos',
            'familia_user_parentesco'   => 'familia_user_parentesco',
            'familia_registro_fiscal' => 'familia_registro_fiscal',
            'familia_hijo' => 'familia_hijo',
        ],
    ],

];
