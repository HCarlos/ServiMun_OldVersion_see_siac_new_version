<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

//        dd($data);
//        dd($data->username);

        $user = User::where("username",$data->username)->first();

//        dd($user);

        if ($user){
            if (Hash::check($data->password, $user->password)){
                $token = $user->createToken("ejemplo");
                $response["status"] = 1;
                $response["msg"] = $token->plainTextToken;
            }else{
                $response["msg"] = "Password incorrecto";
            }
        }else{
            $response["msg"] = "Usuario no encontrado";
        }

        return response()->json($response);

//        $input = [
//            'username' => $request['username'],
//            'password' => $request['password'],
//        ];
//
//        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
//        if(auth('api')->attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {
//            return Auth::user();
//        }else{
//            return response()->json([
//                'message' => 'Acceso Denegado'
//            ], 401);
//        }


    }

}
