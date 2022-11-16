<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserAPIRegistryRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller{

    public function users(){
        $Users = User::query()->take(10)->get();
        return response()->json($Users);
    }

    public function userId($id){
        $Users = User::find($id);
        return response()->json($Users);
    }

    public function userLogin(Request $request){
        $response = ["status"=>0, "msg"=>""];
        $data = (object) $request->all();
        $user = User::where("username",$data->username)->first();
        if ($user){
            if (Hash::check($data->password, $user->password)){
                $token = $user->createToken("ejemplo");
                $response["status"] = 1;
                $response["access_token"] = $token->plainTextToken;
                $response["token_type"] = 'Bearer';
                $response["msg"] = $token->plainTextToken;
            }else{
                $response["msg"] = "Password incorrecto";
            }
        }else{
            $response["msg"] = "Usuario no encontrado";
        }
        return response()->json($response);
    }

    public function userMobileToken(Request $request){
        $response = ["status"=>0, "msg"=>""];
        $data = [
            "username" => "required",
            "password" => "required",
            "device_name" => "required",
        ];
        $data = $request->validate($data);
        $user = User::where('username', $request->username)->first();
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

    public function register(UserAPIRegistryRequest $request){
        $response = ["status"=>0, "msg"=>""];
        $user = $request->manage();
        if ($user){
            $Token = $user->createToken($request->device_name);
            $token = $Token->plainTextToken;

//            $user->sendPasswordResetNotification($token);

            $user->sendEmailVerificationNotification();

            $response["status"] = 1;
            $response["access_token"] = $token;
            $response["token_type"] = 'Bearer';
            $response["username"] = $user->username;
            $response["password"] = $user->password;
            $response["email"] = $user->email;
            $response["msg"] = $token;
        }
        return response()->json($response);
    }



}
