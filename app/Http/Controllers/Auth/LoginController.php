<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

use App\User;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/';

    protected function redirectTo($request)
    {
        if(Auth::check())
            return Redirect::to('/');
        else
            return Redirect::to('login');
    }

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
            $user = User::where('name',$username)->first();
            if($user && Hash::check($password,$user->password))
            {
                Auth::login($user);
                return Redirect::to('/');
            }
            else
            {
                $mensaje = "El usuario o la contraseña son erróneos";
                return Redirect::to('login')->with('mensaje',$mensaje);
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
