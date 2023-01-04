<?php

namespace App\Http\Controllers\Denuncia;

use App\Http\Controllers\Controller;
use App\Models\Denuncias\Denuncia;
use App\Models\Mobiles\Denunciamobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DenunciaMobileController extends Controller{

    protected $tableName = "denunciamobile";
    protected $paginationTheme = 'bootstrap';
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

//        if ( Auth::user()->can('consulta_500_items_general') ){
//            $this->max_item_for_query = config("atemun.consulta_500_items_general");
//        }

        $search = $request->only(['search']);

        $filters['filterdata'] = $request->only(['search']);
        //dd( $filter );
        $items = Denunciamobile::query()
            ->orderByDesc('id')
            ->paginate(1000);
        $items->appends($filters)->fragment('table');

        $request->session()->put('items', $items);

        session(['msg' => '']);

        $user = Auth::User();

        return view('SIAC.denuncia.denuncia.denuncia_mobile_list',
            [
                'items'                   => $items,
                'titulo_catalogo'         => "Solicitudes de Servicios vía Mobile",
                'titulo_header'           => '',
                'user'                    => $user,
                'searchInListDenuncia'    => 'listDenunciasMobile',
                'newWindow'               => true,
                'tableName'               => $this->tableName,
            ]
        );

    }


}
