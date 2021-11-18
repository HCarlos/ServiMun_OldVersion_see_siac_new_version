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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class DenunciaController extends Controller
{


    protected $tableName = "denuncias";
    protected $msg = "";



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
//        $filters = [
//                    'ciudadano_id'=>Auth::user()->id,
//                     $request->only(['search'])
//                    ];
        $search = $request->only(['search']);
        /*
        $IsEnlace =Auth::user()->isRole('ENLACE');
        $DependenciaArray = '';
         IF ($IsEnlace){
             $DependenciaArray = Auth::user()->DependenciaArray;
             //dd( $DependenciaArray );
             $filters['dependencia'] = $DependenciaArray;
         }elseif (Auth::user()->isRole('CIUDADANO|DELEGADO')){
            $filters['ciudadano_id'] = Auth::user()->id;
         }else{
             $filters = $request->only(['search']);
        }
*/
         $filters['filterdata'] = $request->only(['search']);;
         //dd( $filter );
        $items = Denuncia::query()
            ->getDenunciasItemCustomFilter($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');

        //dd($items);

        $request->session()->put('items', $items);

        session(['msg' => '']);


        $user = Auth::User();

        return view('denuncia.denuncia.denuncia_list',
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
            $DependenciaArray = explode('|',Session::get('DependenciaArray'));
            $Dependencias = Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');

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
            $DependenciaArray = explode('|',Session::get('DependenciaArray'));
            $Dependencias = Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');

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
//
//// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
//    protected function editItemV2($Id){
//
//        // BUSCAMOS LA DENUNCIA CIUDADANA
//
//        $item         = Denuncia::find($Id);
//        $Prioridades  = Prioridad::all()->sortBy('prioridad');
//        $Origenes     = Origen::all()->sortBy('origen');
//
//        $IsEnlace = Session::get('IsEnlace');
//        if($IsEnlace){
//            $DependenciaArray = explode('|',Session::get('DependenciaArray'));
//            $Dependencias = Dependencia::all()->whereIn('dependencia',$DependenciaArray,true)->sortBy('dependencia');
//            $Ciudadanos   = User::query()->whereHas('dependencias',function ($r) use ($DependenciaArray) {
//                return $r->whereIn('dependencia',$DependenciaArray);
//            })->get()->sortBy(function ($q){
//                return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
//            });
//
//        }else{
//            $Dependencias = Dependencia::all()->sortBy('dependencia');
//            $Ciudadanos   = User::all()->sortBy(function ($q){
//                return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
//            });
//        }
//
//        $Servicios = Servicio::getQueryServiciosFromDependencias($item->dependencia_id);
//        $Estatus      = Estatu::all()->sortBy('estatus');
//
//        $this->msg = "";
//
//        $itemsDen = [
//            'prioridades'     => $Prioridades,
//            'origenes'        => $Origenes,
//            'dependencias'    => $Dependencias,
//            'servicios'       => $Servicios,
//            'ciudadanos'      => $Ciudadanos,
//            'estatus'         => $Estatus,
//            'items'           => $item,
//            'editItemTitle'   => isset($item->denuncia) ? $item->denuncia : 'Nuevo',
//            'putEdit'         => 'updateDenuncia',
//        ];
//        $tabs[] = ['tab'=>'denuncia','active'=>'active','caption'=>'Denuncia','Method'=>'POST','Route'=>'updateDenuncia','items_forms'=>'SIAC.denuncia.denuncia.__denuncia.__denuncia_edit','tabIndex'=>0,'params'=>$itemsDen];
//
//        // PREPARAMOS SU DOMICILIO
//
//        $itemUbi         = Ubicacion::find($item->ubicacion_id);
//        $Calles          = Calle::all()->sortBy('calle')->pluck('calle','id');
//        $Colonias        = Colonia::all()->sortBy('colonia')->pluck('colonia','id');
//        $Comunidades     = Comunidad::all()->sortBy('comunidad')->pluck('comunidad','id');
//        $Codigospostales = Codigopostal::all()->sortBy('cp')->pluck('cp','id');
//
//        $itemsDom = [
//            'calles'          => $Calles,
//            'colonias'        => $Colonias,
//            'comunidades'     => $Comunidades,
//            'codigospostales' => $Codigospostales,
//            'items'           => $itemUbi,
//            'putEdit'         => 'updateUbicacion',
//        ];
//        $tabs[] = array('tab'=>'domicilio','active'=>'','caption'=>'Domicilio','Method'=>'POST','Route'=>'updateUbicacionV2','items_forms'=>'shared.catalogo.domicilio.ubicacion.__ubicacion_edit','tabIndex'=>1,'params'=>$itemsDom);
//
//        // PREPARAMOS LOS DATOS DEL CIUDADANO QUE LA INTERPONE
//
//        $itemCiu       = User::find($item->ciudadano_id);
//        $itemCiudadano = ['items' => $itemCiu,];
//        $tabs[]        = array('tab'=>'usuario','active'=>'','caption'=>'Usuario','Method'=>'POST','Route'=>'updateUserV2','items_forms'=>'shared.catalogo.user.__user_edit','tabIndex'=>2,'params'=>$itemCiudadano);
//
//        $tabs = json_decode(json_encode($tabs));
//        foreach( $tabs as $tab){
//            if ($tab->tabIndex == 0) {
//                $tab->params = $itemsDen;
//            }elseif($tab->tabIndex == 1){
//                $tab->params = $itemsDom;
//            }elseif($tab->tabIndex == 2){
//                $tab->params = $itemCiudadano;
//            }
//        }
//
//        // dd( $tabs );
//
//        return view('SIAC.denuncia.denuncia.denuncia_edit',
//            [
//                'user'            => Auth::user(),
//                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
//                'titulo_header'   => 'Editando el Folio '.$Id,
//                'msg'             => $this->msg,
//                'tabs'            => $tabs,
//            ]
//        );
//    }

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
            $data[]=array('value'=>$item->calle.' '.$item->num_ext.' '.$item->num_int.' '.$item->colonia.' '.$item->comunidad,' '.$item->ciudad,'id'=>$item->id);
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
                'findDataInDenuncia' => 'findDataInDenuncia',
                'dependencias'       => $Dependencias,
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

//        ->filterBy($filters->filterRulesDenuncia($request))
//        ->getDenunciasItemCustomFilter($filters->filterRulesDenuncia($request))
        $items = Denuncia::query()
            ->filterBy($filters->filterRulesDenuncia($request))
            ->orderByDesc('id')
            ->paginate();
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
