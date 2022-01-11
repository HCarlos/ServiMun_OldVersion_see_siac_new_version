<?php

namespace App\Http\Controllers\Denuncia;

use App\Classes\FiltersRules;
use App\Classes\Items;
use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Domicilios\Calle;
use App\Models\Catalogos\Domicilios\Codigopostal;
use App\Models\Catalogos\Domicilios\Colonia;
use App\Models\Catalogos\Domicilios\Comunidad;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class DenunciaController extends Controller
{


    protected $tableName = "denuncias";
    protected $msg = "";
    protected $max_item_for_query = 250;



// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //

    /**
     * @param string $tableName
     */
    public function __construct(){
        $this->middleware('auth');
    }

    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);

        $search = $request->only(['search']);

        $filters['filterdata'] = $request->only(['search']);;
         //dd( $filter );
        $items = Denuncia::query()
            ->getDenunciasItemCustomFilter($filters)
            ->orderByDesc('id')
            ->paginate($this->max_item_for_query);
        $items->appends($filters)->fragment('table');

        //dd($items);

        $request->session()->put('items', $items);

        session(['msg' => '']);

        $user = Auth::User();

        return view('SIAC.denuncia.denuncia.denuncia_list',
            [
                'items'                   => $items,
                'titulo_catalogo'         => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'           => '',
                'user'                    => $user,
                'searchInListDenuncia'    => 'listDenuncias',
                'newWindow'               => true,
                'tableName'               => $this->tableName,
                'showEdit'                => 'editDenuncia',
                'showEditDenunciaDependenciaServicio'=>'listDenunciaDependenciaServicio',
                'showProcess1'            => 'showDataListDenunciaExcel1A',
                'newItem'                 => 'newDenuncia',
                'removeItem'              => 'removeDenuncia',
                'respuestasDenunciaItem'  => 'listRespuestas',
                'imagenesDenunciaItem'    => 'listImagenes',
                'searchAdressDenuncia'    => 'listDenuncias',
                'showModalSearchDenuncia' => 'showModalSearchDenuncia',
                'findDataInDenuncia'      => 'findDataInDenuncia',
                'imprimirDenuncia'        => "imprimirDenuncia/",
                'IsEnlace'                => session('IsEnlace'),
                'DependenciaArray'        => session('DependenciaArray'),
            ]
        );
    }

    protected function newItem()
    {
        $Prioridades  = Prioridad::all()->sortBy('prioridad');
        $Origenes     = Origen::all()->sortBy('origen');

        $IsEnlace = Session::get('IsEnlace');
        if($IsEnlace){
            $DependenciaIdArray = explode('|',Session::get('DependenciaIdArray'));
            //dd($DependenciaArray);
            $Dependencias = Dependencia::all()->whereIn('id',$DependenciaIdArray,false)->sortBy('dependencia');
            //dd($Dependencias);

        }else{
            $Dependencias = Dependencia::all()->sortBy('dependencia');
        }

        $Estatus      = Estatu::all()->sortBy('estatus');
        $this->msg = "";
        return view('SIAC.denuncia.denuncia.denuncia_new',
            [
                'user'            => Auth::user(),
                'editItemTitle'   => 'Nuevo',
                'prioridades'     => $Prioridades,
                'origenes'        => $Origenes,
                'dependencias'    => $Dependencias,
                'estatus'         => $Estatus,
                'postNew'         => 'createDenuncia',
                'titulo_catalogo' => ucwords($this->tableName),
                'titulo_header'   => 'Folio Nuevo',
                'exportModel'     => 23,
                'msg'             => $this->msg,
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(DenunciaRequest $request){
        $item = $request->manage();
        if (!isset($item->id)) {
            dd($item);
        }
        $this->msg = "Registro Guardado con éxito!";
        session(['msg' => $this->msg]);
        return Redirect::to('editDenuncia/'.$item->id);
    }



    protected function editItem($Id){

        $item         = Denuncia::find($Id);
        $Prioridades  = Prioridad::all()->sortBy('prioridad');
        $Origenes     = Origen::all()->sortBy('origen');

        $IsEnlace = Session::get('IsEnlace');
        if($IsEnlace){
            $DependenciaIdArray = explode('|',Session::get('DependenciaIdArray'));
//            $Dependencias = Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');
            $Dependencias = Dependencia::all()->whereIn('id',$DependenciaIdArray,false)->sortBy('dependencia');

        }else{
            $Dependencias = Dependencia::all()->sortBy('dependencia');
        }


        $Servicios = Servicio::getQueryServiciosFromDependencias($item->dependencia_id);

        $user_ubicacion = $item->Ciudadano->ubicaciones->first->id->id;

        if ( $user_ubicacion == $item->ubicacion_id ){
            $pregunta1 = 0;
        }else{
            $pregunta1 = 1;
        }

        //$pregunta1
        //dd( $Servicios );

        $Estatus      = Estatu::all()->sortBy('estatus');
        $this->msg = "";
        return view('SIAC.denuncia.denuncia.denuncia_edit',
            [
                'user'            => Auth::user(),
                'prioridades'     => $Prioridades,
                'origenes'        => $Origenes,
                'dependencias'    => $Dependencias,
                'servicios'       => $Servicios,
                'estatus'         => $Estatus,
                'items'           => $item,
                'editItemTitle'   => isset($item->denuncia) ? $item->denuncia : 'Nuevo',
                'putEdit'         => 'updateDenuncia',
                'removeItem'      => 'removeImagene',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
                'msg'             => $this->msg,
                'pregunta1'       => $pregunta1,
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
        $this->msg = "Registro Guardado con éxito!";
        session(['msg' => $this->msg]);

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
        ini_set('max_execution_time', 300000);
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
            $data[]=array('value'=>$item->calle.' '.$item->num_ext.' '.$item->num_int.' '.$item->colonia.' '.$item->comunidad,' '.$item->ciudad,'id'=>$item->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No se encontraron resultados','id'=>0];
//        return Response::json(['mensaje' => 'OK', 'data' => json_decode($data), 'status' => '200'], 200);

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

        $Capturistas  = User::query()->whereHas('roles', function ($q) {
            return $q->whereIn('name',array('ENLACE','USER_OPERATOR_SIAC','USER_OPERATOR_ADMIN') );
        } )
            ->get()
            ->sortBy('full_name_with_username_dependencia')
            ->pluck('full_name_with_username_dependencia','id');

        $user = Auth::user();
        return view ('denuncia.search.denuncia_search_panel',
            [
                'findDataInDenuncia' => 'findDataInDenuncia',
                'dependencias'       => $Dependencias,
                'capturistas'        => $Capturistas,
                'servicios'          => $Servicios,
                'estatus'            => $Estatus,
                'items'              => $user,
            ]
        );
    }


 // ***************** MUESTRA EL MENU DE BUSQUEDA ++++++++++++++++++++ //
    protected function findDataInDenuncia(Request $request)
    {
        $filters = new FiltersRules();

        $queryFilters = $filters->filterRulesDenuncia($request);
//        dd($queryFilters);

        $items = Denuncia::query()
            ->filterBy($queryFilters)
            ->orderByDesc('id')
            ->paginate($this->max_item_for_query);
        $items->fragment('table');
        $user = Auth::User();


        $request->session()->put('items', $items);

        return view('denuncia.denuncia.denuncia_list',
            [
                'items'                               => $items,
                'titulo_catalogo'                     => "Catálogo de " . ucwords($this->tableName),
                'user'                                => $user,
                'searchInListDenuncia'                => 'listDenuncias',
                'respuestasDenunciaItem'              => 'listRespuestas',
                'newWindow'                           => true,
                'tableName'                           => $this->tableName,
                'showEdit'                            => 'editDenuncia',
                'newItem'                             => 'newDenuncia',
                'removeItem'                          => 'removeDenuncia',
                'showProcess1'                        => 'showDataListDenunciaExcel1A',
                'searchAdressDenuncia'                => 'listDenuncias',
                'showModalSearchDenuncia'             => 'showModalSearchDenuncia',
                'findDataInDenuncia'                  => 'findDataInDenuncia',
                'showEditDenunciaDependenciaServicio' => 'listDenunciaDependenciaServicio',
                'imagenesDenunciaItem'                => 'listImagenes',
                'imprimirDenuncia'                    => "imprimirDenuncia/",


            ]
        );

    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function getServiciosFromDependencias($id= 0)
    {

        $item = Servicio::getQueryServiciosFromDependencias($id);

        if (isset($item)) {
            return Response::json(['mensaje' => 'OK', 'data' => $item, 'status' => '200'], 200);
        } else {
            return Response::json(['mensaje' => 'Error', 'data' => dd($item), 'status' => '200'], 200);
        }

    }




}
