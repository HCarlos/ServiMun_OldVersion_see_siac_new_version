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
            'categorias'  => 'categorias',
        ],
        'catalogos' => [
            'users'        => 'users',
            'medidas'      => 'medidas',
            'prioridades'  => 'prioridades',
            'estatus'       => 'estatus',
            'origenes'     => 'origenes',
            'dependencias' => 'dependencias',
            'areas'        => 'areas',
            'subareas'     => 'subareas',
            'servicios'    => 'servicios',
            'ubicaciones'  => 'ubicaciones',
            'denuncias'    => 'denuncias',
            'respuestas'   => 'respuestas',
            'user_subarea' => 'user_subarea',
            'subarea_user' => 'subarea_user',
            'denuncia_prioridad'     => 'denuncia_prioridad',
            'denuncia_origen'        => 'denuncia_origen',
            'denuncia_dependencia'   => 'denuncia_dependencia',
            'denuncia_ubicacion'     => 'denuncia_ubicacion',
            'denuncia_servicio'      => 'denuncia_servicio',
            'ciudadano_denuncia'     => 'ciudadano_denuncia',
            'creadopor_denuncia'     => 'creadopor_denuncia',
            'denuncia_modificadopor' => 'denuncia_modificadopor',
            'dependencia_estatu'     => 'dependencia_estatu',
        ],
        'domicilios' => [
            'users'             => 'users',
            'afiliaciones'      => 'afiliaciones',
            'calles'            => 'calles',
            'localidades'       => 'localidades',
            'ciudades'          => 'ciudades',
            'municipios'        => 'municipios',
            'estados'           => 'estados',
            'paises'            => 'paises',
            'tipocomunidades'   => 'tipocomunidades',
            'asentamientos'     => 'asentamientos',
            'tipoasentamientos' => 'tipoasentamientos',
            'codigospostales'   => 'codigospostales',

            'comunidades'       => 'comunidades',
            'colonias'          => 'colonias',

            'sepomex'           => 'sepomex',

            'calle_ubicacion'        => 'calle_ubicacion',
            'colonia_ubicacion'      => 'colonia_ubicacion',
            'comunidad_ubicacion'    => 'comunidad_ubicacion',
            'ciudad_ubicacion'       => 'ciudad_ubicacion',
            'municipio_ubicacion'    => 'municipio_ubicacion',
            'estado_ubicacion'       => 'estado_ubicacion',
            'codigopostal_ubicacion' => 'codigopostal_ubicacion',

            'ubicaciones'            => 'ubicaciones',

            'colonia_comunidad'      => 'colonia_comunidad',
            'codigopostal_colonia'   => 'codigopostal_colonia',
            'colonia_tipocomunidad'  => 'colonia_tipocomunidad',

        ],
    ],

];
