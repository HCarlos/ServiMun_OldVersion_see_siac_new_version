<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Requests\StatuRequest;
use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Estatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EstatuController extends Controller
{
    protected $tableName = "Status";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Estatu::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.estatu.estatu_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInList' => 'listEstatus',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editEstatu',
//                'putEdit' => 'updateEstatu',
                'newItem' => 'newEstatu',
                'removeItem' => 'removeEstatu',
//                'showProcess1' => 'showFileListUserExcel1A',
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $Dependencias = Dependencia::select('id','dependencia')
            ->orderBy('dependencia')
            ->get();
        $item = Estatu::find($Id);
        return view('catalogos.catalogo.estatu.estatu_edit',
            [
                'user' => Auth::user(),
                'items' => $item,
                'editItemTitle' => isset($item->categoria) ? $item->categoria : 'Nuevo',
                'putEdit' => 'updateEstatu',
                'dependencia' => $Dependencias,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(StatuRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editEstatu/'.$item->id);
    }

    protected function newItem()
    {
        $Dependencias = Dependencia::select('id','dependencia')
            ->orderBy('dependencia')
            ->get();
        return view('catalogos.catalogo.estatu.estatu_new',
            [
                'dependencia' => $Dependencias,
                'editItemTitle' => 'Nuevo',
                'postNew' => 'createEstatu',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(StatuRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editEstatu/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Estatu::withTrashed()->findOrFail($id);
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

    protected function addDepEstatu($Id,$IdDep)
    {
        $Estatu = Estatu::find($Id);
        $Estatu->dependencias()->attach($IdDep);
        return Response::json(['mensaje' => 'OK'], 200);
    }

    protected function removeDepEstatu($Id,$IdDep)
    {
        $Estatu = Estatu::find($Id);
        $Estatu->dependencias()->detach($IdDep);
        return Response::json(['mensaje' => 'OK'], 200);
    }

}
