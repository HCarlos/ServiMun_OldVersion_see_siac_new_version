<?php

namespace App\Http\Controllers\Catalogos\Domicilio;

use App\Http\Requests\Domicilio\AsentamientoRequest;
use App\Models\Catalogos\Domicilios\Asentamiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class AsentamientoController extends Controller
{


    protected $tableName = "Asentamientos";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Asentamiento::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.domicilio.asentamiento.asentamiento_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => ' ',
                'user' => $user,
                'searchInList' => 'listAsentamientos',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editAsentamiento',
//                'putEdit' => 'updateAsentamiento',
                'newItem' => 'newAsentamiento',
                'removeItem' => 'removeAsentamiento',
//                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 7,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Asentamiento::find($Id);
        return view('catalogos.catalogo.domicilio.asentamiento.asentamiento_edit',
            [
                'user' => Auth::user(),
                'items' => $item,
                'editItemTitle' => isset($item->categoria) ? $item->categoria : 'Nuevo',
                'putEdit' => 'updateAsentamiento',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(AsentamientoRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editAsentamiento/'.$item->id);
    }

    protected function newItem()
    {
        return view('catalogos.catalogo.domicilio.asentamiento.asentamiento_new',
            [
                'editItemTitle' => 'Nuevo',
                'postNew' => 'createAsentamiento',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro ',
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(AsentamientoRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editAsentamiento/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Asentamiento::withTrashed()->findOrFail($id);
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
