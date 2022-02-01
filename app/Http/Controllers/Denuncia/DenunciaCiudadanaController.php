<?php

namespace App\Http\Controllers\Denuncia;

use App\Http\Requests\Denuncia\DenunciaRequest;
use App\Http\Requests\DenunciaCiudadana\DenunciaCiudadanaRequest;
use App\Models\Catalogos\Dependencia;
use App\Models\Catalogos\Estatu;
use App\Models\Catalogos\Origen;
use App\Models\Catalogos\Prioridad;
use App\Models\Denuncias\Denuncia;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DenunciaCiudadanaController extends Controller{

    protected $tableName = "denuncias";
    protected $msg = "";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->only(['search']);
        if (!Auth::user()->isRole('Administrator|SysOp')){
            $filters['ciudadano_id']=Auth::user()->id;
        }
        $items = Denuncia::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');

        //dd($items);

        $request->session()->put('items', $items);

        $user = Auth::User();

        return view('SIAC.denuncia.denuncia_ciudadana.denuncia_ciudadana_list',
            [
                'items'                           => $items,
                'titulo_catalogo'                 => "Mis " . ucwords($this->tableName),
                'titulo_header'                   => '',
                'user'                            => $user,
                'searchInListDenuncia'            => 'listDenunciasCiudadanas',
                'newWindow'                       => true,
                'tableName'                       => $this->tableName,
                'showEdit'                        => 'editDenunciaCiudadana',
                'showProcess1'                    => 'showDataListDenunciaExcel1A',
                'newItem'                         => 'newDenunciaCiudadana',
                'removeItem'                      => 'removeDenunciaCiudadana',
                'respuestasDenunciaCiudadanaItem' => 'listRespuestasCiudadanas',
                'imagenesDenunciaItem'            => 'listImagenes',
                'searchAdressDenuncia'            => 'listDenuncias',
                'showModalSearchDenuncia'         => 'showModalSearchDenuncia',
                'findDataInDenuncia'              =>'findDataInDenuncia',
                'imprimirDenuncia'                => "imprimirDenuncia/",
                'showEditDenunciaDependenciaServicio'=>'listDenunciaDependenciaServicio',
            ]
        );
    }

    protected function newItem()
    {
        $Prioridades  = Prioridad::all()->sortBy('prioridad');
        $Origenes     = Origen::all()->sortBy('origen');
        $Dependencias = Dependencia::all()->sortBy('dependencia');
        if (Auth::user()->isRole('Administrator|SysOp|USER_OPERATOR_ADMIN|USER_ARCHIVO_ADMIN') ) {
            $Estatus      = Estatu::all()->sortBy('estatus');
        }else{
            $Estatus      = Estatu::all()->where('estatus_cve',1)->sortBy('estatus');
        }
        $this->msg    = "";


        return view('SIAC.denuncia.denuncia_ciudadana.denuncia_ciudadana_new',
            [
                'user'            => Auth::user(),
                'editItemTitle'   => 'Nuevo',
                'prioridades'     => $Prioridades,
                'origenes'        => $Origenes,
                'dependencias'    => $Dependencias,
                'estatus'         => $Estatus,
                'postNew'         => 'createDenunciaCiudadana',
                'titulo_catalogo' => "Mis " . ucwords($this->tableName),
                'titulo_header'   => 'Folio Nuevo',
                'exportModel'     => 23,
                'msg'             => $this->msg,
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(DenunciaCiudadanaRequest $request){
        $item = $request->manageDC();
        return Redirect::to('listDenunciasCiudadanas/');
    }


}
