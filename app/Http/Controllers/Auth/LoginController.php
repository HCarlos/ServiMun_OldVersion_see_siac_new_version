<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {
            //return redirect()->route('home');
            //$this->redirectPath();
            $role = Auth::user()->hasRole('Administrator|SysOp|Capturista-A|Capturista-B|Capturista-C');
            if ($role) {
                return redirect()->route('home');
            } else {
                return redirect()->route('home-ciudadano');
            }

        }else{
            return redirect()->route('login')
                ->with('error','Username, email ó password incorrecto');
        }

    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function redirectPath()
    {
        $role = Auth::user()->hasRole('Administrator|SysOp|Capturista');
        if ($role) {
            return redirect()->route('home');
        } else {
            return redirect()->route('home-ciudadano');
        }
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->session_id){
            Session::getHandler()->destroy($user->session_id);
        }
        $user->session_id = session()->getId();
        $user->save();
        return redirect()->intended($this->redirectPath());
    }



}
