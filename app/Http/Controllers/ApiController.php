<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // El login genera un nuevo token y te lo devuelve para que lo uses como autenticación en las peticiones de la API (Bearer Token)
    public function login(Request $request)
    {
        $request->validate([
            'login'       => 'required|string',
            'password'    => 'required|string',
        ]);
        $credentials = request(['login', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales incorrectas.'], 401);
        }

        $nivel = $request->user()['nivel_desarrollador'];
        if ($nivel == NULL)
        {
            return response()->json([
                'message' => 'No eres desarrollador.'], 401);
        }
        
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }

    // El logout elimina el token de la base de datos para que no sea reconocido
    public function logout(Request $request)
    {
        $request->user()->forceFill([
            'api_token' => NULL,
        ])->save();

        return response()->json([
            'message' => 'Sesión cerrada.'], 200);
    }


    
    public function testBajo(Request $request)
    {
        return response()->json([
            'message' => 'ACCIÓN DE DESARROLLADOR BAJO'], 200);
    }

    public function testAlto(Request $request)
    {
        $nivel = $request->user()['nivel_desarrollador'];
        if ($nivel != 'alto')
        {
            return response()->json([
                'message' => 'No eres desarrollador alto.'], 401);
        }

        return response()->json([
            'message' => 'ACCIÓN DE DESARROLLADOR ALTO'], 200);
    }
}
