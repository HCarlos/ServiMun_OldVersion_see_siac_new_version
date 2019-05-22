<?php

namespace App\Http\Controllers\Catalogos\Domicilio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Domicilio\CodigopostalRequest;
use App\Models\Catalogos\Domicilios\Codigopostal;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class CodigopostalController extends Controller
{


    protected $tableName = "Codigos Postales";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Codigopostal::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.domicilio.cp.cp_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInList' => 'listCodigopostales',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editCodigopostal',
//                'putEdit' => 'updateCodigopostal',
                'newItem' => 'newCodigopostal',
                'removeItem' => 'removeCodigopostal',
//                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 10,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Codigopostal::find($Id);
        return view('catalogos.catalogo.domicilio.cp.cp_edit',
            [
                'user' => Auth::user(),
                'items' => $item,
                'editItemTitle' => isset($item->categoria) ? $item->categoria : 'Nuevo',
                'putEdit' => 'updateCodigopostal',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(CodigopostalRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editCodigopostal/'.$item->id);

    }

    protected function newItem()
    {
        return view('catalogos.catalogo.domicilio.cp.cp_new',
            [
                'editItemTitle' => 'Nuevo',
                'postNew' => 'createCodigopostal',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(CodigopostalRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editCodigopostal/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Codigopostal::withTrashed()->findOrFail($id);
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
