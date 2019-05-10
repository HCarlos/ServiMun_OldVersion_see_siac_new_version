<?php

namespace App\Http\Controllers\Denuncia;

use App\Models\Denuncias\Denuncia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DenunciaCiudadanaController extends Controller
{


    protected $tableName = "denuncias";

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

        $request->session()->put('items', $items);

        $user = Auth::User();

        return view('denuncia.denuncia_ciudadana.denuncia_ciudadana_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'user' => $user,
                'searchInListDenuncia' => 'listDenunciasCiudadanas',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'showEdit' => 'editDenunciaCiudadana',
                'showProcess1' => 'showDataListDenunciaExcel1A',
//                'putEdit' => 'updateDenuncia',
                'newItem' => 'newDenunciaCiudadana9',
                'removeItem' => 'removeDenunciaCiudadana',
                'respuestasDenunciaCiudadanaItem' => 'listRespuestasCiudadanas',
                'imagenesDenunciaItem' => 'listImagenes',
                'searchAdressDenuncia' => 'listDenuncias',
                'showModalSearchDenuncia' => 'showModalSearchDenuncia',
                'findDataInDenuncia'=>'findDataInDenuncia',
                'imprimirDenuncia'=> "imprimirDenuncia/",
            ]
        );
    }



}
