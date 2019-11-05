<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

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

    public function index()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('login');
    }

    public function login()
    {
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = User::where('username',$username)->where('password',$password)->first();
            if($user)
            {
                Auth::login($user);
                Redirect::to('index');
            }
            //unset($_SESSION['usernotfound']);
        } else {
            //Os dejo varias formas de hacerla
            $mensaje = "El usuario o la contraseña son erróneos";
            //$_SESSION['usernotfound'] = $mensaje;
            //O
            //Session::flash('message',$mensaje);
            //O
            return Redirect::to('login')->with('mensaje',$mensaje);
        }
    }
}
