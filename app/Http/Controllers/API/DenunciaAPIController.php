<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\DenunciaAPIRequest;
use App\Http\Requests\API\UserAPIChangePasswordRequest;
use App\Models\Mobiles\Denunciamobile;
use App\Models\Mobiles\Imagemobile;
use App\Models\Mobiles\Serviciomobile;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DenunciaAPIController extends Controller{

    public function addDenunciaMobile(DenunciaAPIRequest $request):JsonResponse {
        $response = ["status"=>0, "msg"=>""];
        $den = $request->manage();
        if ($den){
            $response["status"] = 1;
            $response["msg"] = "Solicitud de servicio enviada con éxito!";
        }
        return response()->json($response);
    }

    public function getDenuncias(int $user_id): JsonResponse{
        $response = ["status"=>0, "msg"=>""];
        $dens = Denunciamobile::select(['id','denuncia','fecha','latitud','longitud','ubicacion','ubicacion_google','user_id','serviciomobile_id'])
            ->where("user_id",trim($user_id))
            ->get();
        if ($dens){
            $response["status"] = 1;
            $response["msg"] = "OK";

            $denucias = array();
            foreach ($dens as $den){
                $Ser = Serviciomobile::find($den->serviciomobile_id);
                $imagenes = Imagemobile::select(['id','fecha','filename','filename_png','filename_thumb','user_id','denunciamobile_id','latitud','longitud']
                )->where("denunciamobile_id",$den->id)
                    ->get();
                foreach ($imagenes as $imagen){
                    $imagen["url"] =config("atemun.public_url")."/storage/mobile/denuncia/".$imagen->filename;
                    $imagen["url_png"] =config("atemun.public_url")."/storage/mobile/denuncia/".$imagen->filename_png;
                    $imagen["url_thumb"] =config("atemun.public_url")."/storage/mobile/denuncia/".$imagen->filename_thumb;
                }
                $d = [
                    'id' => $den->id,
                    'denuncia' => $den->denuncia,
                    'fecha' => $den->fecha,
                    'latitud' => $den->latitud,
                    'longitud' => $den->longitud,
                    'ubicacion' => $den->ubicacion,
                    'ubicacion_google' => $den->ubicacion_google,
                    'servicio' => $Ser->servicio,
                    'imagenes' => $imagenes,
                ];
                $denucias[] = $d;
            }
            $response["denuncias"] = $denucias;
        }
        return response()->json($response);

    }




}
