<?php

namespace App\Http\Controllers\Denuncia;

use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Denuncia;
use Illuminate\Http\Request;
use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Ciudad;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Estado;
use App\Models\Catalogos\Domicilios\Localidad;
use App\Models\Catalogos\Domicilios\Municipio;
use App\Http\Controllers\Controller;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Http\Requests\Domicilio\DenunciaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class DenunciaController extends Controller
{


    protected $tableName = "denuncias";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Denuncia::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('denuncia.denuncia.denuncia_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInList' => 'listDenuncias',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editDenuncia',
//                'putEdit' => 'updateDenuncia',
                'newItem' => 'newDenuncia',
                'removeItem' => 'removeDenuncia',
                'searchAdressDenuncia' => 'listDenuncias',
//                'showProcess1' => 'showFileListUserExcel1A',
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item            = Denuncia::find($Id);
        $Calles          = Calle::all()->sortBy('calle');
        $Colonias        = Colonia::all()->sortBy('colonia');
        $Localidades     = Localidad::all()->sortBy('localidad');
        $Ciudades        = Ciudad::all()->sortBy('ciudad');
        $Municipios      = Municipio::all()->sortBy('municipio');
        $Estadps         = Estado::all()->sortBy('estado');
        $Codigospostales = Codigopostal::all()->sortBy('cp');

        return view('denuncia.denuncia.denuncia_edit',
            [
                'user' => Auth::user(),
                'calles'          => $Calles,
                'colonias'        => $Colonias,
                'localidades'     => $Localidades,
                'ciudades'        => $Ciudades,
                'municipios'      => $Municipios,
                'estados'         => $Estadps,
                'codigospostales' => $Codigospostales,
                'items'           => $item,
                'editItemTitle'   => isset($item->denuncia) ? $item->denuncia : 'Nuevo',
                'putEdit'         => 'updateDenuncia',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(DenunciaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(405);
        }
        return Redirect::to('editDenuncia/'.$item->id);
    }

    protected function newItem()
    {
        $Calles          = Calle::all()->sortBy('calle');
        $Colonias        = Colonia::all()->sortBy('colonia');
        $Localidades     = Localidad::all()->sortBy('localidad');
        $Ciudades        = Ciudad::all()->sortBy('ciudad');
        $Municipios      = Municipio::all()->sortBy('municipio');
        $Estadps         = Estado::all()->sortBy('estado');
        $Codigospostales = Codigopostal::all()->sortBy('cp');
        return view('denuncia.denuncia.denuncia_new',
            [
                'editItemTitle'   => 'Nuevo',
                'calles'          => $Calles,
                'colonias'        => $Colonias,
                'localidades'     => $Localidades,
                'ciudades'        => $Ciudades,
                'municipios'      => $Municipios,
                'estados'         => $Estadps,
                'codigospostales' => $Codigospostales,
                'postNew'         => 'createDenuncia',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(DenunciaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(404);
        }
        return Redirect::to('editDenuncia/'.$item->id);
    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Denuncia::withTrashed()->findOrFail($id);
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



// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function searchAdress(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters =$request->input('search');
        $F           = new FuncionesController();
        $tsString    = $F->string_to_tsQuery( strtoupper($filters),' & ');
        $items = Ubicacion::query()
            ->search($tsString)
            ->orderByDesc('id')
            ->get();
        $data=array();

        foreach ($items as $item) {
            $data[]=array('value'=>$item->calle.' '.$item->colonia.' '.$item->localidad,' '.$item->ciudad,'id'=>$item->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No se encontraron resultados','id'=>0];

    }

// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function getUbi($IdUbi=0)
    {
        $items = Ubicacion::find($IdUbi);
        return Response::json(['mensaje' => 'OK', 'data' => json_decode($items), 'status' => '200'], 200);

    }





}
