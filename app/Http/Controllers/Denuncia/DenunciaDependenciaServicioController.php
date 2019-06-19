<?php

namespace App\Http\Controllers\Denuncia;

use App\Models\Denuncias\Denuncia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DenunciaDependenciaServicioController extends Controller
{




    protected $tableName = "denuncia_dependencia_servicio";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index($Id)
    {
        ini_set('max_execution_time', 300);

//        $filters = $request->only(['search']);
//        if (!Auth::user()->isRole('Administrator|SysOp')){
//            $filters['ciudadano_id']=Auth::user()->id;
//        }

//        $items = Denuncia::query()
//            ->filterBy($filters)
//            ->orderByDesc('id')
//            ->paginate();
//        $items->appends($filters)->fragment('table');

        $items = Denuncia::with('dependencias')
            ->where('id',$Id)
            ->paginate();

        $items->appends('dds')->fragment('table');

//        dd($items);

//        $request->session()->put('items', $items);

        $user = Auth::User();

        return view('denuncia.denuncia_dependencia_servicio.denuncia_dependencia_servicio_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
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

/*

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
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(DenunciaDependenciaServicioRequest $request)
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
                'titulo_catalogo' => "Mis " . ucwords($this->tableName),
                'titulo_header'   => 'Folio Nuevo',
                'exportModel' => 23,
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(DenunciaDependenciaServicioRequest $request)
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

*/


}
