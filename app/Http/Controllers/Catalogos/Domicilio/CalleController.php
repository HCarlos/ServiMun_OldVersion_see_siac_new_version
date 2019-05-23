<?php

namespace App\Http\Controllers\Catalogos\Domicilio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Domicilio\CalleRequest;
use App\Models\Catalogos\Domicilios\Calle;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class CalleController extends Controller
{


    protected $tableName = "Calles";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Calle::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.domicilio.calle.calle_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => ' ',
                'user' => $user,
                'searchInList' => 'listCalles',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editCalle',
//                'putEdit' => 'updateCalle',
                'newItem' => 'newCalle',
                'removeItem' => 'removeCalle',
//                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 8,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Calle::find($Id);
        return view('catalogos.catalogo.domicilio.calle.calle_edit',
            [
                'user' => Auth::user(),
                'items' => $item,
                'editItemTitle' => isset($item->categoria) ? $item->categoria : 'Nuevo',
                'putEdit' => 'updateCalle',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(CalleRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editCalle/'.$item->id);
    }

    protected function newItem()
    {
        return view('catalogos.catalogo.domicilio.calle.calle_new',
            [
                'editItemTitle' => 'Nuevo',
                'postNew' => 'createCalle',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro ',
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(CalleRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('editCalle/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Calle::withTrashed()->findOrFail($id);
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
