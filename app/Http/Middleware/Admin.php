<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;
use App\User;

class Admin
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
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        $idusuario = Session::get('idusuario');
        if(isset($idusuario) && !empty($idusuario))
        {
            $user = User::where('login',$idusuario)->first();
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