<?php

namespace App\Http\Controllers\Denuncia;

use App\Classes\FiltersRules;
use App\Classes\Items;
use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Domicilios\Ubicacion;
use App\Models\Catalogos\Estatu;
use App\Models\Catalogos\Origen;
use App\Models\Catalogos\Prioridad;
use App\Models\Catalogos\Servicio;
use App\Models\Denuncias\Denuncia;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Denuncia\DenunciaRequest;
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
        $filters = $request->only(['search']);
        //dd($filters);
        $items = Denuncia::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');

        $request->session()->put('items', $items);

//        $sv = Items::getInstance();
//        $sv->setItems($items);
//
//        //dd($sv->getItems());


        $user = Auth::User();

        return view('denuncia.denuncia.denuncia_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInListDenuncia' => 'listDenuncias',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editDenuncia',
                'showProcess1' => 'showDataListDenunciaExcel1A',
//                'putEdit' => 'updateDenuncia',
                'newItem' => 'newDenuncia',
                'removeItem' => 'removeDenuncia',
                'respuestasDenunciaItem' => 'listRespuestas',
                'imagenesDenunciaItem' => 'listImagenes',
                'searchAdressDenuncia' => 'listDenuncias',
                'showModalSearchDenuncia' => 'showModalSearchDenuncia',
                'findDataInDenuncia'=>'findDataInDenuncia',
                'imprimirDenuncia'=> "imprimirDenuncia/",
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item         = Denuncia::find($Id);
        $Prioridades  = Prioridad::all()->sortBy('prioridad');
        $Origenes     = Origen::all()->sortBy('origen');
        $Dependencias = Dependencia::all()->sortBy('dependencia')->pluck('dependencia','id');
        $Servicios    = Servicio::all()->sortBy('servicio')->pluck('servicio','id');
        $Ciudadanos   = User::all()->sortBy(function ($q){
            return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
        });
        $Estatus      = Estatu::all()->sortBy('estatus');

        return view('denuncia.denuncia.denuncia_edit',
            [
                'user'            => Auth::user(),
                'prioridades'     => $Prioridades,
                'origenes'        => $Origenes,
                'dependencias'    => $Dependencias,
                'servicios'       => $Servicios,
                'ciudadanos'      => $Ciudadanos,
                'estatus'         => $Estatus,
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
        //dd($item);
        if (!isset($item->id)) {
            abort(405);
        }
        return Redirect::to('editDenuncia/'.$item->id);
    }

    protected function newItem()
    {
        $Prioridades  = Prioridad::all()->sortBy('prioridad');
        $Origenes     = Origen::all()->sortBy('origen');
        $Dependencias = Dependencia::all()->sortBy('dependencia')->pluck('dependencia','id');
        $Servicios    = Servicio::all()->sortBy('servicio')->pluck('servicio','id');
        $Ciudadanos   = User::all()->sortBy(function ($q){
           return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
        });
        $Estatus      = Estatu::all()->sortBy('estatus');

        return view('denuncia.denuncia.denuncia_new',
            [
                'user'            => Auth::user(),
                'editItemTitle'   => 'Nuevo',
                'prioridades'     => $Prioridades,
                'origenes'        => $Origenes,
                'dependencias'    => $Dependencias,
                'servicios'       => $Servicios,
                'ciudadanos'      => $Ciudadanos,
                'estatus'         => $Estatus,
                'postNew'         => 'createDenuncia',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(DenunciaRequest $request)
    {
        $item = $request->manage();
//        dd($item);
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
            ->orderBy('id')
            ->get();
        $data=array();

        foreach ($items as $item) {
//            $data[]=array('value'=>$item->id.' '.$item->calle.' '.$item->colonia.' '.$item->comunidad,' '.$item->ciudad,'id'=>$item->id);
            $data[]=array('value'=>$item->calle.' '.$item->colonia.' '.$item->comunidad,' '.$item->ciudad,'id'=>$item->id);
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

    protected function showModalSearchDenuncia(){
        $Dependencias = Dependencia::all()->sortBy('dependencia')->pluck('dependencia','id');
        $Servicios    = Servicio::all()->sortBy('servicio')->pluck('servicio','id');
        $Estatus      = Estatu::all()->sortBy('estatus');

        $user = Auth::user();
        return view ('denuncia.search.denuncia_search_panel',
            [
                'findDataInDenuncia'=>'findDataInDenuncia',
                'dependencias'    => $Dependencias,
                'servicios'       => $Servicios,
                'estatus'         => $Estatus,
                'items' => $user,
            ]
        );
    }


 // ***************** MUESTRA EL MENU DE BUSQUEDA ++++++++++++++++++++ //
    protected function findDataInDenuncia(Request $request)
    {
        $filters = new FiltersRules();

        $items = Denuncia::query()
            ->filterBy($filters->filterRulesDenuncia($request))
            ->orderByDesc('id')
            ->paginate();
        $items->fragment('table');
        $user = Auth::User();

        $request->session()->put('items', $items);

        return view('denuncia.denuncia.denuncia_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInListDenuncia' => 'listDenuncias',
                'respuestasDenunciaItem' => 'listRespuestas',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editDenuncia',
                'newItem' => 'newDenuncia',
                'removeItem' => 'removeDenuncia',
                'showProcess1' => 'showDataListDenunciaExcel1A',
                'searchAdressDenuncia' => 'listDenuncias',
                'showModalSearchDenuncia' => 'showModalSearchDenuncia',
                'findDataInDenuncia'=>'findDataInDenuncia',
            ]
        );

    }






}
