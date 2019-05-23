<?php

namespace App\Http\Controllers\Denuncia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalogos\Prioridad;
use App\Http\Requests\Denuncia\PrioridadRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class PrioridadController extends Controller
{

    protected $tableName = "Prioridades";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Prioridad::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.prioridad.prioridad_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
                'user' => $user,
                'searchInList' => 'listPrioridades',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editPrioridad',
//                'putEdit' => 'updatePrioridad',
                'newItem' => 'newPrioridad',
                'removeItem' => 'removePrioridad',
//                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 27,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Prioridad::find($Id);
        return view('catalogos.catalogo.prioridad.prioridad_edit',
            [
                'user' => Auth::user(),
                'items' => $item,
                'editItemTitle' => isset($item->categoria) ? $item->categoria : 'Nuevo',
                'putEdit' => 'updatePrioridad',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(PrioridadRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editPrioridad/'.$item->id);
    }

    protected function newItem()
    {
        return view('catalogos.catalogo.prioridad.prioridad_new',
            [
                'editItemTitle' => 'Nuevo',
                'postNew' => 'createPrioridad',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro',
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(PrioridadRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editPrioridad/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Prioridad::withTrashed()->findOrFail($id);
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
