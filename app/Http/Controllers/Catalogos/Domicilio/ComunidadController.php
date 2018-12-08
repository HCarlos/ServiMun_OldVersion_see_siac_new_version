<?php

namespace App\Http\Controllers\Catalogos\Domicilio;

use App\Http\Requests\Domicilio\ComunidadRequest;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Comunidad;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Models\Catalogos\Domicilios\Tipocomunidad;
use App\Traits\Catalogos\Domicilio\Comunidad\ComunidadTrait;
use App\Traits\Common\CommonTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class ComunidadController extends Controller
{
    use ComunidadTrait, CommonTrait;

    protected $tableName = "comunidades";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Comunidad::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('catalogos.catalogo.domicilio.comunidad.comunidad_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInList' => 'listComunidades',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editComunidad',
//                'putEdit' => 'updateComunidad',
                'newItem' => 'newComunidad',
                'removeItem' => 'removeComunidad',
//                'showProcess1' => 'showFileListUserExcel1A',
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Comunidad::find($Id);
        $Ciudades       = Ciudad::all()->sortBy('ciudad');
        $Municipios     = Municipio::all()->sortBy('municipio');
        $Estados        = Estado::all()->sortBy('estado');

        $Ciudad_Id      = Ciudad::all()->where('ciudad',env('CIUDAD_DEFAULT'))->first();
        $Municipio_Id   = Municipio::all()->where('municipio',env('MUNICIPIO_DEFAULT'))->first();
        $Estado_Id      = Estado::all()->where('estado',env('ESTADO_DEFAULT'))->first();

        $Delegados = $this->getUserFromRoles('DELEGADO');
        $Tipocomunidades = Tipocomunidad::all(['id','tipocomunidad'])->sortBy('tipocomunidad');

        return view('catalogos.catalogo.domicilio.comunidad.comunidad_edit',
            [
                'user' => Auth::user(),
                'delegados' => $Delegados,
                'tipocomunidades' => $Tipocomunidades,
                'ciudades' => $Ciudades,
                'municipios' => $Municipios,
                'estados' => $Estados,
                'ciudad_id' => $Ciudad_Id->id,
                'municipio_id' => $Municipio_Id->id,
                'estado_id' => $Estado_Id->id,
                'items' => $item,
                'editItemTitle' => isset($item->comunidad) ? $item->comunidad : 'Nuevo',
                'putEdit' => 'updateComunidad',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(ComunidadRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(404);
        }
        return Redirect::to('editComunidad/'.$item->id);
    }

    protected function newItem()
    {
        $Ciudades       = Ciudad::all()->sortBy('ciudad');
        $Municipios     = Municipio::all()->sortBy('municipio');
        $Estados        = Estado::all()->sortBy('estado');

        $Ciudad_Id      = Ciudad::all()->where('ciudad',env('CIUDAD_DEFAULT'))->first();
        $Municipio_Id   = Municipio::all()->where('municipio',env('MUNICIPIO_DEFAULT'))->first();
        $Estado_Id      = Estado::all()->where('estado',env('ESTADO_DEFAULT'))->first();

        $Delegados = $this->getUserFromRoles('DELEGADO');
        $Tipocomunidades = Tipocomunidad::all(['id','tipocomunidad'])->sortBy('tipocomunidad');
        //dd($Delegados);
        return view('catalogos.catalogo.domicilio.comunidad.comunidad_new',
            [
                'editItemTitle' => 'Nuevo',
                'delegados' => $Delegados,
                'tipocomunidades' => $Tipocomunidades,
                'ciudades' => $Ciudades,
                'municipios' => $Municipios,
                'estados' => $Estados,
                'ciudad_id' => $Ciudad_Id->id,
                'municipio_id' => $Municipio_Id->id,
                'estado_id' => $Estado_Id->id,
                'postNew' => 'createComunidad',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(ComunidadRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(404);
        }
        return Redirect::to('editComunidad/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Comunidad::withTrashed()->findOrFail($id);
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
