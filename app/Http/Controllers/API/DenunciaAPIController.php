<?php

namespace App\Http\Controllers\API;

use App\Events\APIDenunciaEvent;
use App\Events\InserUpdateDeleteEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\DenunciaAddImageAPIRequest;
use App\Http\Requests\API\DenunciaAddRespuestaAPIRequest;
use App\Http\Requests\API\DenunciaAPIRequest;
use App\Http\Requests\API\UserAPIChangePasswordRequest;
use App\Models\Mobiles\Denunciamobile;
use App\Models\Mobiles\Imagemobile;
use App\Models\Mobiles\Respuestamobile;
use App\Models\Mobiles\Serviciomobile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DenunciaAPIController extends Controller{

    public function insertDenunciaMobile(DenunciaAPIRequest $request):JsonResponse {
        $response = ["status"=>0, "msg"=>""];
        $den = (object)  $request->manage();
        if ($den){
            $response["status"] = 1;
            $response["msg"] = "Solicitud de servicio enviada con éxito!";
//            event(new APIDenunciaEvent(1, 2));
        }
        return response()->json($response);
    }

    public function getDenuncias(Request $request): JsonResponse{
        $response = ["status"=>0, "msg"=>""];
        $data = (object) $request->all();
        $user_id = $data->user_id;

        $dens = Denunciamobile::select(['id','denuncia','fecha','latitud','longitud','ubicacion','ubicacion_google','user_id','serviciomobile_id'])
            ->where("user_id",$user_id)
            ->OrderByDesc("id")
            ->get();
        if ($dens){
            $response["status"] = 1;
            $response["msg"] = "OK";
            $denucias = array();
            foreach ($dens as $den){

                $Ser = Serviciomobile::find($den->serviciomobile_id);

                // Obtenemos sus imágenes
                $imagenes = Imagemobile::select(['id','fecha','filename','filename_png','filename_thumb','user_id','denunciamobile_id','latitud','longitud']
                )->where("denunciamobile_id",$den->id)
                    ->OrderByDesc("id")
                    ->get();
                foreach ($imagenes as $imagen){
                    $fecha               = (new Carbon($imagen->fecha))->format('d-m-Y H:i:s');
                    $path = "/storage/mobile/denuncia/";
                    $imagen['fecha']     = $fecha;
                    $imagen["url"]       = config("atemun.public_url").$path.$imagen->filename;
                    $imagen["url_png"]   = config("atemun.public_url").$path.$imagen->filename_png;
                    $imagen["url_thumb"] = config("atemun.public_url").$path.$imagen->filename_thumb;
                }

                // Obtenemos sus respuestas
                $respuestas = Respuestamobile::select(['id','fecha','respuesta','observaciones'])
                    ->where("denunciamobile_id",$den->id)
                    ->OrderBy("id")
                    ->get();
                foreach ($respuestas as $resp){
                    $fecha                 = (new Carbon($resp->fecha))->format('d-m-Y H:i:s');
                    $resp['fecha']         = $fecha;
                }

                $fecha = (new Carbon($den->fecha))->format('d-m-Y H:i:s');
                $d = [
                    'id'               => $den->id,
                    'denuncia'         => $den->denuncia,
                    'fecha'            => $fecha,
                    'latitud'          => $den->latitud,
                    'longitud'         => $den->longitud,
                    'ubicacion'        => $den->ubicacion,
                    'ubicacion_google' => $den->ubicacion_google,
                    'servicio'         => $Ser->servicio,
                    'imagenes'         => $imagenes,
                    'respuestas'       => $respuestas,
                ];
                $denucias[] = $d;
            }
            $response["denuncias"] = $denucias;
        }
//        event(new InserUpdateDeleteEvent(1,$response));
        return response()->json($response);

    }

    public function addRespuestaDenunciaMobile(DenunciaAddRespuestaAPIRequest $request):JsonResponse {
        $response = ["status"=>0, "msg"=>"Ha ocurrido un error al subir la imagen"];
        $den = (object)  $request->manage();
        if ($den){
            $response["status"] = 1;
            $response["msg"] = "Su respuesta fue agregada correctamente!";
        }
        return response()->json($response);
    }





}
