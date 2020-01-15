<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EleccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getelecciones(Request $request)
    {
        $nivel = $request->user()['nivel_desarrollador'];
        if ($nivel == NULL)
        {
            return response()->json([
                'message' => 'No eres desarrollador.'], 401);
        }



        else
        {
             $elecciones= Eleccion::where('esRestringida', '1')->get();
             $miarray = [];
             foreach ($elecciones as $e ) {
                $tipo;
                if ($e->esVinculante=='1') {
                    $tipo="consulta";
                }
                elseif ($e->esRestringida=='0') {
                    $tipo="secreta";
                }

                $subarray=array( "id_vot" => $p->id,"tit_vot"=>$p->titulo ,"opciones"=>$p->opciones,"vincul_vot" => $p->esVinculante ); 
                array_push($miarray, $subarray);
             }
            $json =json_encode($miarray);
            $json2=json_encode($elecciones);
            return $json2;
             //return responde()->json()
        }

    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    /*
    public function store(Request $request)
    {

        $nivel = $request->user()['nivel_desarrollador'];
        if ($nivel == NULL)
        {
            return response()->json([
                'message' => 'No eres desarrollador.'], 401);
        }

        elseif ($nivel == 'bajo') 
        {
             return response()->json([
                'message' => 'No estas autorizado para esta operacion'], 401);
        }

        else
        {
            $eleccion=new Eleccion;
        
        $eleccion->censoVotante=$request->votantes;

        if ($request->consulta=='true') {
            $eleccion->esVinculante='0';
        
        }
        else
        {
             $eleccion->esVinculante='1';
        }

         if ($request->secreta=='true') {
            $eleccion->esRestringida='0';
        }
        else
        {
             $eleccion->esRestringida='1';
        }

         if ($request->treal=='true') {
            $eleccion->esTiempoReal='0';
        }
        else
        {
             $eleccion->esTiempoReal='1';
        }

        if ($request->esAnticipada=='true') {
            $eleccion->esAnticipada='0';
        }
        else
        {
             $eleccion->esAnticipada='1';
        }

        if ($request->esCompleja=='true') {
            $eleccion->esCompleja='0';
        }
        else
        {
             $eleccion->esCompleja='1';
        }

        if ($request->seMuestraAntes=='true') {
            $eleccion->seMuestraAntes='0';
        }
        else
        {
             $eleccion->seMuestraAntes='1';
        }

        $eleccion->titulo=$request->titulo;
        $eleccion->opciones=$request->opciones;
        $eleccion->fechaComienzo=$request->fechaComienzo;
        $eleccion->fechaFin=$request->fechaFin;
        
        $eleccion->save();

        return 'ELECCION CREADA';
        }
        
    }

    */ 
    /**
     
}
