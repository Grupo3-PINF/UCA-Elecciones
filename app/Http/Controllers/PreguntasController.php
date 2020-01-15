<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpreguntas(Request $request)
    {
        $nivel = $request->user()['nivel_desarrollador'];
        if ($nivel == NULL)
        {
            return response()->json([
                'message' => 'No eres desarrollador.'], 401);
        }



        else
        {
             $preguntas= Pregunta::where('esRestringida', '1')->get();
             $miarray = [];
             foreach ($preguntas as $p ) {
                $tipo;
                if ($p->esVinculante=='1') {
                    $tipo="consulta";
                }
                elseif ($p->esRestringida=='0') {
                    $tipo="secreta";
                }

                $subarray=array( "id_vot" => $p->id,"tit_vot"=>$p->titulo ,"opciones"=>$p->opciones,"vincul_vot" => $p->esVinculante ); 
                array_push($miarray, $subarray);
             }
            $json =json_encode($miarray);
            $json2=json_encode($preguntas);
            return $json2;
             //return responde()->json()
        }

    }

    /*$value = array( 
    "name"=>"GFG", 
    "email"=>"abc@gfg.com"); 
   
// Use json_encode() function 
$json = json_encode($value); 
   
// Display the output 
echo($json); 
*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /*crearPregunta(consulta, titulo, opciones, votantes, fecha, hora, tiempo, fecha_anticipada, secreta, secreto_opcional)


id  wallet  idCreador   titulo  esCompleja  opciones    esVinculante    esAnticipada    esRestringida   esTiempoReal    seMuestraAntes  fechaComienzo   fechaFin    fechaComienzoAnticipada     fechaFinAnticipada  recuento    censoVotante    created_at  updated_at */
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
            $pregunta=new Pregunta;
        
        $pregunta->censoVotante=$request->votantes;

        if ($request->consulta=='true') {
            $pregunta->esVinculante='0';
        
        }
        else
        {
             $pregunta->esVinculante='1';
        }

         if ($request->secreta=='true') {
            $pregunta->esRestringida='0';
        }
        else
        {
             $pregunta->esRestringida='1';
        }

         if ($request->treal=='true') {
            $pregunta->esTiempoReal='0';
        }
        else
        {
             $pregunta->esTiempoReal='1';
        }

        if ($request->esAnticipada=='true') {
            $pregunta->esAnticipada='0';
        }
        else
        {
             $pregunta->esAnticipada='1';
        }

        if ($request->esCompleja=='true') {
            $pregunta->esCompleja='0';
        }
        else
        {
             $pregunta->esCompleja='1';
        }

        if ($request->seMuestraAntes=='true') {
            $pregunta->seMuestraAntes='0';
        }
        else
        {
             $pregunta->seMuestraAntes='1';
        }

        $pregunta->titulo=$request->titulo;
        $pregunta->opciones=$request->opciones;
        $pregunta->fechaComienzo=$request->fechaComienzo;
        $pregunta->fechaFin=$request->fechaFin;
        
        $pregunta->save();

        return 'PREGUNTA CREADA';
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
