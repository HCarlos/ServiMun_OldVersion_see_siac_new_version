<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\DenunciaAPIRequest;
use App\Http\Requests\API\UserAPIChangePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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




}
