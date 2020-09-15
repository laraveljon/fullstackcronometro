<?php

namespace App\Http\Controllers;

use App\tareas;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $tareas = tareas::orderBy('id','desc')->paginate(10);
        //return $tareas;
        // foreach ($tareas as $res) {

        //     //fecha
        //     $fecha = $res->fecha;
        //     // return $fecha;
        //     $res_Fecha = substr($fecha,0,10);
        //     // asgignar hora
        //     $asignarH = $res->asignar_hora;
        //     $res_hora = substr($asignarH,11,8);
        //    // return $res_hora;
        //     // hora final
        //     $asignarH_F = $res->tiempo_termino;
        //     $res_hora_final = substr($asignarH_F,11,8);

        //     // return $res_hora;
        // }


        // return view('tareas.index', compact('tareas'));
       // return view('tareas.index',['tareas'=>$tareas]);
          return view('tareas.prueba',['tareas'=>$tareas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //return $request;

        $tarea = new tareas([
                'descripcion'=>$request->post('txtDescripcion'),
                'tipo_duracion'=>$request->post('txtTipo_duracion'),
                'asignar_hora'=>$request->post('txtAsignarHora'),
                'fecha'=>$request->post('txtFecha'),
                'tiempo_termino'=>$request->post('txtTerminoHora'),
                'status'=>$request->post('txtStatus')
        ]);

        //return $tarea;

        $tarea->save();
        return \Response::json($tarea);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function show(tareas $tareas)
    {
        //
    }

    public function modificar(Request $request){
//tipo_duracion

          //

           if($request->asignar_hora != ''){

            $busquedaId = tareas::where('asignar_hora','=', $request->asignar_hora)->firts();

           // return $busquedaId;
            //return $request;
            //$modifcar = tareas::where(['asignar_hora' => $request->asignar_hora])->update(['status' => 'terminada']);

           // return $modifcar; 00:00:0500:00:05

                $modificar = tareas::find($busquedaId);
                //dd($modificar);
                $modificar->status = $request->status;
                $modificar->tiempo_termino = $request->tiempo_termino;
                $modificar->update();

                return \Response::json($modificar);
           }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function edit(tareas $tareas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tareas $tareas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tareas  $tareas
     * @return \Illuminate\Http\Response
     */
    public function destroy(tareas $tareas)
    {
        //
    }
}
