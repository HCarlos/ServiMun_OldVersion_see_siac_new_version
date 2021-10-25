<?php

namespace App\Http\Controllers\Catalogos\Dependencia;

use App\Http\Requests\Dependencia\AreaRequest;
use App\Models\Catalogos\Area;
use App\Models\Catalogos\Dependencia;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class AreaController extends Controller
{
    protected $tableName = "Áreas";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Area::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.dependencias.area.area_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => ' ',
                'user' => $user,
                'searchInList' => 'listAreas',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editArea',
//                'putEdit' => 'updateArea',
                'newItem' => 'newArea',
                'removeItem' => 'removeArea',
//                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 4,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editArea($Id)
    {
        $item = Area::find($Id);
        $Jefes = User::all()->sortBy(function($item) {
            return $item->ap_paterno.' '.$item->ap_materno.' '.$item->nombre;
        });
        $Dependencias = Dependencia::select('id','dependencia')
            ->orderBy('dependencia')
            ->get();

        return view('catalogos.catalogo.dependencias.area.area_edit',
            [
                'user' => Auth::user(),
                'jefes' => $Jefes,
                'dependencia' => $Dependencias,
                'items' => $item,
                'editItemTitle' => isset($item->dependencia) ? $item->dependencia : 'Nuevo',
                'putEdit' => 'updateArea',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateArea(AreaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('listAreas');
    }

    protected function newArea()
    {
        $Jefes = User::all()->sortBy(function($item) {
            return $item->ap_paterno.' '.$item->ap_materno.' '.$item->nombre;
        });
        $Dependencias = Dependencia::select('id','dependencia')
            ->orderBy('dependencia')
            ->get();
        return view('catalogos.catalogo.dependencias.area.area_new',
            [
                'editItemTitle' => 'Nuevo',
                'jefes' => $Jefes,
                'dependencia' => $Dependencias,
                'postNew' => 'createArea',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro ',
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createArea(AreaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('listAreas');
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeArea($id = 0)
    {
        $item = Area::withTrashed()->findOrFail($id);
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
