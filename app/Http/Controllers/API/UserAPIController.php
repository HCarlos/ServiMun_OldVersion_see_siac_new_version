<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserAPIImageRequest;
use App\Http\Requests\API\UserAPIRegistryRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller{

    public function users():JsonResponse {
        $Users = User::query()->take(10)->get();
        return response()->json($Users);
    }

    public function userId($id):JsonResponse {
        $Users = User::find($id);
        return response()->json($Users);
    }

    public function userCURP($curp):JsonResponse {
        $Users = User::where('curp',strtoupper(trim($curp)))->get();
        return response()->json($Users);
    }

    public function userLogin(Request $request):JsonResponse {
        $response = ["status"=>0, "msg"=>""];
        $data = (object) $request->all();
        $user = User::where("username",trim($data->username))->first();
        if ($user){
            if (Hash::check($data->password, $user->password)){
                $token = $user->createToken("ejemplo");
                $response["status"] = 1;
                $response["access_token"] = $token->plainTextToken;
                $response["token_type"] = 'Bearer';
                $response["msg"] = $token->plainTextToken;
                $response["user"] = $user;
            }else{
                $response["msg"] = "Password incorrecto";
            }
        }else{
            $response["msg"] = "Usuario no encontrado";
        }
        return response()->json($response);
    }

    public function userMobileToken(Request $request):JsonResponse {
        $response = ["status"=>0, "msg"=>""];
        $data = [
            "username" => "required",
            "password" => "required",
            "device_name" => "required",
        ];
        $data = $request->validate($data);
        $user = User::where('username', strtoupper(trim($request->username)))->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken($request->device_name);
                $response["status"] = 1;
                $response["access_token"] = $token->plainTextToken;
                $response["token_type"] = 'Bearer';
                $response["msg"] = $token->plainTextToken;
            } else {
                $response = ["status" => 0, "msg" => "Password incorrecto"];
            }
        }else{
            $response = ["status" => 0, "msg" => "Usuario no encontrado"];
        }
        return response()->json($response);
    }

    public function register(UserAPIRegistryRequest $request):JsonResponse {
        $response = ["status"=>0, "msg"=>""];
        $user = $request->manage();
        if ($user){

            $Token = $user->createToken($request->device_name);
            $token = $Token->plainTextToken;
            $user->sendEmailVerificationNotification();

            $response["status"] = 1;
            $response["access_token"] = $token;
            $response["token_type"] = 'Bearer';
            $response["username"] = strtoupper(trim($user->username));
            $response["password"] = $user->password;
            $response["email"] = $user->email;
            $response["ap_paterno"] = strtoupper(trim($user->ap_paterno));
            $response["ap_materno"] = strtoupper(trim($user->ap_materno));
            $response["nombre"] = strtoupper(trim($user->nombre));
            $response["msg"] = $token;
        }
        return response()->json($response);
    }

    public function userImage(UserAPIImageRequest $request):JsonResponse {
        $response = ["status"=>0, "msg"=>""];

//        dd( $request->all() );

        $user = $request->manage();
        if ($user){
            $response["status"] = 1;
            $response["msg"] = "Imagen actualizada con éxito";
        }
        return response()->json($response);
    }


}
