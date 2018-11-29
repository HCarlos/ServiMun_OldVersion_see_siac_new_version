<?php

namespace App\Http\Controllers\Catalogos\Domicilio;

use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Localidad;
use App\Models\Catalogos\Domicilios\Municipio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Http\Requests\Domicilio\UbicacionRequest;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Domicilios\Comunidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class UbicacionController extends Controller
{


    protected $tableName = "ubicaiones";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Ubicacion::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.domicilio.ubicacion.ubicacion_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInList' => 'listUbicaciones',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editUbicacion',
//                'putEdit' => 'updateUbicacion',
                'newItem' => 'newUbicacion',
                'removeItem' => 'removeUbicacion',
//                'showProcess1' => 'showFileListUserExcel1A',
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item            = Ubicacion::find($Id);
        $Calles          = Calle::all()->sortBy('calle');
        $Colonias        = Colonia::all()->sortBy('colonia');
        $Localidades     = Localidad::all()->sortBy('localidad');
        $Ciudades        = Ciudad::all()->sortBy('ciudad');
        $Municipios      = Municipio::all()->sortBy('municipio');
        $Estadps         = Estado::all()->sortBy('estado');
        $Codigospostales = Codigopostal::all()->sortBy('cp');

        return view('catalogos.catalogo.domicilio.ubicacion.ubicacion_edit',
            [
                'user' => Auth::user(),
                'calles'          => $Calles,
                'colonias'        => $Colonias,
                'localidades'     => $Localidades,
                'ciudades'        => $Ciudades,
                'municipios'      => $Municipios,
                'estados'         => $Estadps,
                'codigospostales' => $Codigospostales,
                'items'           => $item,
                'editItemTitle'   => isset($item->ubicacion) ? $item->ubicacion : 'Nuevo',
                'putEdit'         => 'updateUbicacion',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(UbicacionRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(405);
        }
        return Redirect::to('editUbicacion/'.$item->id);
    }

    protected function newItem()
    {
        $Calles          = Calle::all()->sortBy('calle');
        $Colonias        = Colonia::all()->sortBy('colonia');
        $Localidades     = Localidad::all()->sortBy('localidad');
        $Ciudades        = Ciudad::all()->sortBy('ciudad');
        $Municipios      = Municipio::all()->sortBy('municipio');
        $Estadps         = Estado::all()->sortBy('estado');
        $Codigospostales = Codigopostal::all()->sortBy('cp');
        return view('catalogos.catalogo.domicilio.ubicacion.ubicacion_new',
            [
                'editItemTitle'   => 'Nuevo',
                'calles'          => $Calles,
                'colonias'        => $Colonias,
                'localidades'     => $Localidades,
                'ciudades'        => $Ciudades,
                'municipios'      => $Municipios,
                'estados'         => $Estadps,
                'codigospostales' => $Codigospostales,
                'postNew'         => 'createUbicacion',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(UbicacionRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(404);
        }
        return Redirect::to('editUbicacion/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Ubicacion::withTrashed()->findOrFail($id);
        if (isset($item)) {
            if (!$item->trashed()) {
                $item->forceDelete();
            } else {
                $item->forceDelete();
            }
            return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
        } else {
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }
    }







}
