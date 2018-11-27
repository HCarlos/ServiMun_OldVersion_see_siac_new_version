<?php

namespace App\Http\Controllers\Catalogos\Dependencia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dependencia\SubareaRequest;
use App\Models\Catalogos\Subarea;
use App\Models\Catalogos\Area;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class SubareaController extends Controller
{
    protected $tableName = "subareas";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Subarea::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.dependencias.subarea.subarea_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInList' => 'listSubareas',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editSubarea',
//                'putEdit' => 'updateSubarea',
                'newItem' => 'newSubarea',
                'removeItem' => 'removeSubarea',
//                'showProcess1' => 'showFileListUserExcel1A',
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editSubarea($Id)
    {
        $item = Subarea::find($Id);
        $Jefes = User::all()->sortBy(function($item) {
            return $item->ap_paterno.' '.$item->ap_materno.' '.$item->nombre;
        });
        $Areas = Area::select('id','area')
            ->orderBy('area')
            ->get();

        return view('catalogos.catalogo.dependencias.subarea.subarea_edit',
            [
                'user' => Auth::user(),
                'jefes' => $Jefes,
                'area' => $Areas,
                'items' => $item,
                'editItemTitle' => isset($item->subarea) ? $item->subarea : 'Nuevo',
                'putEdit' => 'updateSubarea',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateSubarea(SubareaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editSubarea/'.$item->id);
    }

    protected function newSubarea()
    {
        $Jefes = User::all()->sortBy(function($item) {
            return $item->ap_paterno.' '.$item->ap_materno.' '.$item->nombre;
        });
        $Areas = Area::select('id','area')
            ->orderBy('area')
            ->get();
        return view('catalogos.catalogo.dependencias.subarea.subarea_new',
            [
                'editItemTitle' => 'Nuevo',
                'jefes' => $Jefes,
                'area' => $Areas,
                'postNew' => 'createSubarea',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createSubarea(SubareaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editSubarea/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeSubarea($id = 0)
    {
        $item = Subarea::withTrashed()->findOrFail($id);
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
