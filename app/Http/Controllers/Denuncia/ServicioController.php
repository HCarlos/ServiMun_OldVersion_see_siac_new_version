<?php

namespace App\Http\Controllers\Denuncia;

use App\Classes\RemoveItemSafe;
use App\Http\Requests\Denuncia\ServicioRequest;
use App\Models\Catalogos\Medida;
use App\Models\Catalogos\Servicio;
use App\Models\Catalogos\Subarea;
use App\Models\Denuncias\Denuncia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class ServicioController extends Controller
{

    protected $tableName = "Servicios";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Servicio::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.servicio.servicio_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
                'user' => $user,
                'searchInList' => 'listServicios',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editServicio',
//                'putEdit' => 'updateServicio',
                'newItem' => 'newServicio',
                'removeItem' => 'removeServicio',
//                'showProcess1' => 'showFileListUserExcel1A',
                'exportModel' => 2,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Servicio::find($Id);
        $medidas = Medida::all(['id','medida'])->sortBy('medida');
        $subareas = Subarea::all()->sortBy('subarea');
        //dd($item);
        return view('catalogos.catalogo.servicio.servicio_edit',
            [
                'user' => Auth::user(),
                'items' => $item,
                'medidas' => $medidas,
                'subareas' => $subareas,
                'editItemTitle' => isset($item->categoria) ? $item->categoria : 'Nuevo',
                'putEdit' => 'updateServicio',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(ServicioRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('listServicios');
    }

    protected function newItem()
    {
        $medidas = Medida::all(['id','medida'])->sortBy('medida');
        $subareas = Subarea::all()->sortBy('subarea');
        return view('catalogos.catalogo.servicio.servicio_new',
            [
                'editItemTitle' => 'Nuevo',
                'postNew' => 'createServicio',
                'medidas' => $medidas,
                'subareas' => $subareas,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro',
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(ServicioRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('listServicios');
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Servicio::withTrashed()->findOrFail($id);
        if (isset($item)) {
            return RemoveItemSafe::RemoveItemObject($item,'servicio_id',$id);
        } else {
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }
    }


}
