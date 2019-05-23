<?php

namespace App\Http\Controllers\Catalogos\Dependencia;

use App\Http\Requests\Dependencia\DependenciaRequest;
use App\Models\Catalogos\Dependencia;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class DependenciaController extends Controller
{

    protected $tableName = "dependencias";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Dependencia::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
//        dd($items);
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

//        dd($items);

        return view('catalogos.catalogo.dependencias.dependencia.dependencia_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
                'user' => $user,
                'searchInList' => 'listDependencias',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editDependencia',
//                'putEdit' => 'updateDependencia',
                'newItem' => 'newDependencia',
                'removeItem' => 'removeDependencia',
//                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 3,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editDependencia($Id)
    {
        $item = Dependencia::find($Id);
        $Jefes = User::all()->sortBy(function($item) {
            return $item->ap_paterno.' '.$item->ap_materno.' '.$item->nombre;
        });

        return view('catalogos.catalogo.dependencias.dependencia.dependencia_edit',
            [
                'user' => Auth::user(),
                'jefes' => $Jefes,
                'items' => $item,
                'editItemTitle' => isset($item->dependencia) ? $item->dependencia : 'Nuevo',
                'putEdit' => 'updateDependencia',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateDependencia(DependenciaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editDependencia/'.$item->id);
    }

    protected function newDependencia()
    {
        $Jefes = User::all()->sortBy(function($item) {
            return $item->ap_paterno.' '.$item->ap_materno.' '.$item->nombre;
        });
        return view('catalogos.catalogo.dependencias.dependencia.dependencia_new',
            [
                'editItemTitle' => 'Nuevo',
                'jefes' => $Jefes,
                'postNew' => 'createDependencia',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro',
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createDependencia(DependenciaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editDependencia/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeDependencia($id = 0)
    {
        $item = Dependencia::withTrashed()->findOrFail($id);
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
