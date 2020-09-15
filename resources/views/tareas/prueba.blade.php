@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-11">
            <h2>Tareas</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addModal">Agregar Tarea</a>

    </div><br><br>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="cronometro">

    <div id="hms"></div>
    <div class="boton start"></div>
    <div class="boton stop"></div>
    <div class="boton reiniciar"></div>
</div>

<table class="table table-bordered" id="tareaTable">
    <thead class="info">
      <tr>
        <th class="danger">Id</th>
        <th class="danger">Descripcion</th>
        <th class="danger">Tipo de Duracion</th>
        <th class="danger">Asignar tiempo de tarea</th>
        <th class="danger">Tiempo Termino de la Tarea</th>
        <th class="danger">Fecha</th>
        <th class="danger">status</th>
        {{-- <th class="danger">Cronometro</th> --}}
        <th class="danger">accion</th>


      </tr>
    </thead>
    <tbody>
        {{-- iria el foreach --}}
        @foreach ($tareas as $tarea)
          <tr>
           <td class="id_">{{$tarea->id}}</td>
           <td>{{$tarea->descripcion}}</td>
           <td class="tipo_duracion_">{{$tarea->tipo_duracion}}</td>
           <td class="hora_asignada_">{{ substr($tarea->asignar_hora,11,8)  }}</td>
           <td>{{ substr($tarea->tiempo_termino,11,8) }} </td>
           <td>{{ substr($tarea->fecha,0,10)}} </td>
           <td>{{$tarea->status}}</td>
           <td>
            <div class="dropdown">
                <button class="btn btn-success" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dLabel">
                    <a data-id="{{ $tarea->id }}" class="dropdown-item" href="#">
                        <button type="button" class="btn btn-primary btnEdit">Editar</button>
                      </a>
                      <a data-id="{{ $tarea->id }}" class="dropdown-item" href="#">
                        <button type="button" class="btn btn-danger btnDelete">Eliminar</button>
                      </a>
                </ul>
              </div>

            </td>

            </td>
           </tr>
        @endforeach
    </tbody>

  </table>

  {{-- <form action="">

    <input type="button" value="ok" id="ok" class="boton2">
  </form> --}}

{{$tareas->links()}}



<script>
    // cronometro
    window.onload = init;
            function init(){
                document.querySelector(".start").addEventListener("click",cronometrar);
                document.querySelector(".stop").addEventListener("click",parar);
                document.querySelector(".reiniciar").addEventListener("click",reiniciar);
                h = 0;
                m = 0;
                s = 0;
                document.getElementById("hms").innerHTML="00:00:00";
            }
            function cronometrar(){
                escribir();
                id = setInterval(escribir,1000);
                document.querySelector(".start").removeEventListener("click",cronometrar);
            }
            function escribir(){
                var hAux, mAux, sAux;
                s++;
                if (s>59){m++;s=0;}
                if (m>59){h++;m=0;}
                if (h>24){h=0;}

                if (s<10){sAux="0"+s;}else{sAux=s;}
                if (m<10){mAux="0"+m;}else{mAux=m;}
                if (h<10){hAux="0"+h;}else{hAux=h;}
                                                                       //hr         min          seg
               var tiempo = document.getElementById("hms").innerHTML = hAux + ":" + mAux + ":" + sAux;

            // if(tiempo == )
               console.log("Tiempo : " + tiempo);

                var tipo_duracion = "";
                var hora_asignada = "";
                // var id = "";
                    // tipo de duracion
                    $(".tipo_duracion_").parent("tr").find(".tipo_duracion_").each(function() {

                            if($(this).html() != ""){
                                //console.log("Entra 1");
                            tipo_duracion += $(this).html() + ",";
                        }
                    });
                     // hora de assignacion
                    $(".hora_asignada_").parent("tr").find(".hora_asignada_").each(function() {

                        if($(this).html() != ""){
                            //console.log("Entra 1");
                            hora_asignada += $(this).html() + ",";
                        }
                    });

                    // $(".id_").parent("tr").find(".id_").each(function() {

                    //     if($(this).html() != ""){
                    //         //console.log("Entra 1");
                    //         id += $(this).html() + ",";
                    //     }
                    // });



                    tipo_duracion = tipo_duracion;
                    hora_asignada = hora_asignada;
                    // id = id;
                    //alert(nombre);
                //console.log("HOLA MUNDO " + tipo_duracion);
                    var tipo_duraciones = tipo_duracion.split(",");
                    var hora_asignadas = hora_asignada.split(",");
                    // var ids            = id.split(",");
                    //console.log(tipo_duracion);
                    //console.log(tipo_duraciones);
                    //console.log(tipo_duraciones.length);

                    for (let index = 0; index < hora_asignadas.length; index++) {
                                    // const element = array[index];

                         console.log("Horas : " + hora_asignadas[index]);

                                        // if(hora_asignadas[index] == "00:00:05"){

                                        // }
                            if(tiempo == hora_asignadas[index]){
                                            // iria el ajax para cambiar el status y tiempo de termino
                                    console.log("hora ", hAux," Minuto es ", mAux, " Segundos " , sAux);
                                    // tipo de duracion
                                    for (let index = 0; index < tipo_duraciones.length; index++) {


                                        switch (tipo_duraciones[index]) {
                                            case "corta":

                                                    if(hAux < 01 && mAux <= 30 && sAux <= 59 ){
                                                            //console.log("Corta Entra Ajax 1");

                                                            var tipo_duracion = tipo_duraciones[index];
                                                            var asignar_hora = hora_asignadas[index]
                                                            var status = "terminada";
                                                            var tiempo_termino = tiempo;

                                                            if(tiempo == hora_asignadas[index]){

                                                                console.log("Tipo de duracion",tipo_duracion, " hora asignada" , asignar_hora, " status", status, " tiempo_termino ", tiempo_termino);

                                                                    $.ajax({
                                                                        url:"{{route('tareas.modificar')}}",
                                                                        data:{
                                                                            "_token": "{{ csrf_token() }}",
                                                                            tipo_duracion: tipo_duracion, asignar_hora:asignar_hora, status:status, tiempo_termino:tiempo_termino},

                                                                            type:"POST",
                                                                            dataType:'json',
                                                                        success: function(data){

                                                                            console.log("This is ",data);

                                                                           // return;

                                                                            var tarea = '<tr id="'+data.id+'">';

                                                                            tarea += '<td>' + data.id + '</td>';
                                                                            tarea += '<td>' + data.descripcion + '</td>';
                                                                            tarea += '<td class="tipo_duracion_">' + data.tipo_duracion + '</td>';
                                                                            tarea += '<td class="hora_asignada_">' + data.asignar_hora + '</td>';
                                                                            tarea += '<td>' + data.fecha + '</td>';
                                                                            tarea += '<td>' + data.tiempo_termino + '</td>';
                                                                            tarea += '<td>' + data.status + '</td>';
                                                                            tarea += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Editar</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Eliminar</a></td>';
                                                                            tarea += '</tr>';
                                                                            $('#tareaTable tbody').prepend(tarea);
                                                                            // $('#addTarea')[0].reset();
                                                                            // $('#addModal').modal('hide');

                                                                        }

                                                                    });

                                                            }

                                                    }
                                            break;

                                            case "media":

                                                    if(mAux >= 30 && sAux <= 59 && hAux == 00){
                                                            console.log("Media Entra Ajax 1");
                                                        }else if(hAux == 01 && mAux == 00 && sAux <=59){
                                                            console.log("Media Entra ajax 2");
                                                        }
                                            break;

                                            case "larga":
                                                    if(hAux >=  01 && mAux <= 59 && sAux <= 59){
                                                                console.log("Larga Entra Ajax 3");
                                                        }
                                            break;

                                            default:

                                            break;
                                        }

                                    }
                                }
                                    //console.log("<br />");
                    }

                //  var asignar_hora = $('#asignar_hora').val();
                //  var tiempo_termino = $('#tiempo_termino').val();
                //  var fecha = $('#fecha').val();

                 //console.log("asignar "+ asignar_hora + " tiempo termino " +tiempo_termino +  " fecha " + fecha );

                return;

                // if( hAux=='00' && mAux == '00' && sAux == '05'){
                //    // alert("Hey jon");
                //    console.log("Esto es a " + mAux+":"+sAux);
                //    //reiniciar();
                // }
            }
            function parar(){
                clearInterval(id);
                document.querySelector(".start").addEventListener("click",cronometrar);

            }
            function reiniciar(){
                clearInterval(id);
                document.getElementById("hms").innerHTML="00:00:00";
                h=0;m=0;s=0;
                document.querySelector(".start").addEventListener("click",cronometrar);
            }





</script>



@endsection
