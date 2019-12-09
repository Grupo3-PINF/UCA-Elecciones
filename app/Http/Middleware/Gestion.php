<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Gestion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        session_start();
        if(isset($_SESSION['idusuario']) && !empty($_SESSION['idusuario']))
        {
            $user = User::where('login',$_SESSION['idusuario'])->first();
            $rol = strtolower($user->rolActivo);
            if($rol == 'administrador' || $rol == 'secretario')
            {
                return $next($request);
            }
            else
            {
                return redirect('/');
            }


        }
        else
        {
            return redirect('/');
        }
    }
}