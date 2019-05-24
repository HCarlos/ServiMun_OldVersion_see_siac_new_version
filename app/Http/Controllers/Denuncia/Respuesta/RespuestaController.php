<?php

namespace App\Http\Controllers\Denuncia\Respuesta;

use App\Http\Requests\Denuncia\Respuesta\RespuestaRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Denuncia\Respuesta\RespuestARespuestaRequest;
use App\Models\Denuncias\Respuesta;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class RespuestaController extends Controller
{

//************************************************************************************
//************             R   E   S   P   U   E   S   T   A   S                    ***
//***************************************************************+++++++++++++++++++**

    protected $tableName = "respuestas";

    // Obtiene el Listado de Respuestas
    protected function index($Id)
    {

        $items = Respuesta::select()
            ->whereHas('denuncias', function ($q) use ($Id) {
                return $q->where('denuncia_id',$Id);
            })
            ->orderByDesc('id','parent__id')
            ->paginate();

        $user = Auth::User();

        return view('denuncia.respuesta.respuesta_list',
            [
                'items' => $items,
                'titulo_catalogo' => ucwords($this->tableName).' de la denuncia: '.$Id,
                'titulo_header'   => '',
                'user' => $user,
                'searchInListRespuesta' => 'listRespuestas',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'newItem' => '/showModalRespuestaNew',
                'editItem' => '/showModalRespuestaEdit',
                'showEdit' => 'editDenuncia',
                'denuncia_id' => $Id,
                'removeItem' => 'removeRespuesta',
                'findDataInRespuesta'=>'findDataInRespuesta',
                'exportModel' => 21,
                'new2Item' => '/RespuestaARespuestaNew',
                'RespuestaARespuestaNew' => '/RespuestaARespuestaNew',
                'RespuestaARespuestaEdit' => '/RespuestaARespuestaEdit',
            ]
        );

    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Respuesta::withTrashed()->findOrFail($id);
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

    protected function showModalRespuestaNew($denuncia_id){
        $user = Auth::user();
        $Ciudadanos   = User::all()->sortBy(function ($q){
            return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
        });

        return view ('denuncia.respuesta.respuesta_new_modal',
            [
                'saveRespuestaDen'=>'saveRespuestaDen',
                'denuncia_id' => $denuncia_id,
                'ciudadanos' => $Ciudadanos,
                'user' => $user,
            ]
        );
    }

    protected function showModalRespuestaEdit($Id){
        $user = Auth::user();
        $resp = Respuesta::find($Id);
        $Ciudadanos   = User::all()->sortBy(function ($q){
            return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
        });
        return view ('denuncia.respuesta.respuesta_edit_modal',
            [
                'saveRespuestaDen'=>'saveRespuestaDen',
                'denuncia_id' => $resp->denuncia->id,
                'ciudadanos' => $Ciudadanos,
                'id' => $Id,
                'user' => $user,
                'item' => $resp,
            ]
        );
    }

    protected function saveRespuestaDen(RespuestaRequest $request){
        $item = $request->manage();
        if (isset($item)){
            return Response::json(['mensaje' => 'Información guardada con éxito!', 'data' => 'OK', 'status' => '200'], 200);
        }else{
            return Response::json(['mensaje' => 'Hubo un error!', 'data' => $item, 'status' => '422'], 200);
        }
    }


// RESPUESTA A RESPUESTA

    protected function RespuestaARespuestaNew($denuncia_id,$respuesta_id){
        $user = Auth::user();
        $Ciudadanos   = User::all()->sortBy(function ($q){
            return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
        });

        return view ('denuncia.respuesta_a_respuesta.respuesta_a_respuesta_new_modal',
            [
                'saveRespuestaARespuestaDen'=>'saveRespuestaARespuestaDen',
                'denuncia_id' => $denuncia_id,
                'respuesta_id' => $respuesta_id,
                'ciudadanos' => $Ciudadanos,
                'user' => $user,
            ]
        );
    }

//    protected function RespuestaARespuestaEdit($Id){
//        $user = Auth::user();
//        $resp = Respuesta::find($Id);
//        $Ciudadanos   = User::all()->sortBy(function ($q){
//            return trim($q->ap_paterno).' '.trim($q->ap_materno).' '.trim($q->nombre);
//        });
//        return view ('denuncia.respuesta_a_respuesta.respuesta_a_respuesta_edit_modal',
//            [
//                'saveRespuestaARespuestaDen'=>'saveRespuestaARespuestaDen',
//                'denuncia_id' => $resp->denuncia->id,
//                'respuesta_id' => $Id,
//                'ciudadanos' => $Ciudadanos,
//                'id' => $Id,
//                'user' => $user,
//                'item' => $resp,
//            ]
//        );
//    }

    protected function saveRespuestaARespuestaDen(RespuestARespuestaRequest $request){
        $item = $request->manage();
        if (isset($item)){
            return Response::json(['mensaje' => 'Información guardada con éxito!', 'data' => 'OK', 'status' => '200'], 200);
        }else{
            return Response::json(['mensaje' => 'Hubo un error!', 'data' => $item, 'status' => '422'], 200);
        }
    }










}
