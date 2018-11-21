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

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function redirectPath()
    {
        $user = Auth::user();
        $role = $user->hasRole(['Administrator', 'SysOp', 'Capturista']);
        if ($role) {
            $xxx = property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
            return $xxx;
//        }elseif( $user->hasRole('alumno') ){
//            $this->redirectTo = '/home_alumno';
//            return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home_alumno';
//        }elseif( $user->hasRole('administrator') ){
//            $this->redirectTo = '/home';
//            return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
        } else {
            return '/home';
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
