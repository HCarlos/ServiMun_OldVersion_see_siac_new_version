<?php

namespace App\Http\Controllers\Denuncia\Imagene;

use App\Http\Controllers\Controller;
use App\Http\Requests\Denuncia\Imagene\ImageneRequest;
use App\Models\Denuncias\Denuncia;
use App\Models\Denuncias\Imagene;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Funciones\FuncionesController;

class ImageneController extends Controller{


//************************************************************************************
//************             R   E   S   P   U   E   S   T   A   S                    ***
//***************************************************************+++++++++++++++++++**

    protected $tableName = "imagenes";
    protected $disk = 'denuncia';
    protected $F;

    // Obtiene el Listado de Imagenes
    protected function index($Id)
    {

        $items = Imagene::select()
            ->whereHas('denuncias', function ($q) use ($Id) {
                return $q->where('denuncia_id',$Id);
            })
            ->orderByDesc('id')
            ->paginate();

        $user = Auth::User();

        return view('denuncia.images.imagene_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Imagenes de " . ucwords($this->tableName),
                'user' => $user,
                'searchInListImagene' => 'listImagenes',
                'newWindow' => true,
                'tableName' => $this->tableName,
                'newItem' => '/showModalImageneNew',
                'editItem' => '/showModalImageneEdit',
                'denuncia_id' => $Id,
                'removeItem' => 'removeImagene',
                'showEdit' => 'editDenuncia',
                'findDataInImagene'=>'findDataInImagene',
            ]
        );

    }

// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Imagene::withTrashed()->findOrFail($id);
        if (isset($item)) {
            if (!$item->trashed()) {
                $item->forceDelete();
            } else {
                $item->forceDelete();
            }
            $item->users()->detach($item->user__id);
            $den = Denuncia::find($item->denuncia__id);
            $den->imagenes()->detach($item->id);

            $this->F = new FuncionesController();
            $this->F->deleteImageDropZone($item->image,$this->disk);
            $this->F->deleteImageDropZone($item->image_thumb,$this->disk);
            return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
        } else {
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }
    }

    protected function showModalImageneNew($denuncia_id){
        $user = Auth::user();
        return view ('denuncia.images.imagene_upload',
            [
                'saveImageneDen'=>'saveImageneDen',
                'denuncia_id' => $denuncia_id,
                'removeItem' => 'removeImagene',
                'user' => $user,
            ]
        );
    }

    protected function showModalImageneEdit($Id){
        $user = Auth::user();
        $item = Imagene::find($Id);
        //dd();
        //dd( Input::get('images') );

        return view ('denuncia.images.imagene_edit_data',
            [
                'saveImageneDen'=>'saveImageneDen',
                'item' => $item,
                'user' => $user,
            ]
        );
    }

    protected function saveImageneDen(ImageneRequest $request){
        $data = $request->only(['id']);
        if ( $data['id'] == 0 ){
            $item = $request->manage();
        }else{
            $request->manageEdit();
            $item = Imagene::find($data['id']);
        }
        if (isset($item)){
//            dd($item);
            return Response::json(['mensaje' => 'Información guardada con éxito!', 'data' => 'OK', 'status' => '200','filename'=>$item->image,'Id'=>$item->id], 200);
        }else{
            return Response::json(['mensaje' => 'Hubo un error!', 'data' => $item, 'status' => '422','filename'=>'','Id'=>-1], 200);
        }
    }


}
