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
                   <td>{{$tarea->descripcion}}</td>
                   <td class="tipo_duracion_">{{$tarea->tipo_duracion}}</td>
                   <td><input type="text" class="sinborde" id="asignar_hora" name="asignar_hora" value="{{ substr($tarea->asignar_hora,11,8)  }}" /></td>
                   <td><input type="text" class="sinborde" id="tiempo_termino" name="tiempo_termino" value="{{ substr($tarea->tiempo_termino,11,8) }}" /> </td>
                   <td><input type="text" class="sinborde" id="fecha" name="fecha" value="{{ substr($tarea->fecha,0,10)}}" > </td>
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

{{$tareas->links()}}

    {{-- Agregar el modal --}}
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- tarea Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add tarea </h4>
            </div>
         <div class="modal-body">
         <form id="addTarea" name="addTarea" action="{{ route('tareas.store')}}" method="post">
       @csrf

            <div class="form-group">
                <label for="txtDescripcion">Descripcion:</label>
                <textarea class="form-control"
                          id="txtDescripcion"
                          name="txtDescripcion"
                          rows="3"
                          placeholder="Asigna la tarea">
                </textarea>
            </div>

            <div class="form-group">
                <select class="custom-select" name="txtTipo_duracion" id="txtTipo_duracion">
                    <option selected>Tipo de duracion de la tarea</option>
                    <option value="corta">Corta</option>
                    <option value="media">Media</option>
                    <option value="larga">Larga</option>
                </select>
            </div>

            <div class="form-group">
                <label for="txtAsignarHora">Asignar Hora:</label>
                <input type="text" class="form-control" id="txtAsignarHora" name="txtAsignarHora" value="00:00:00">
                {{-- <input type="time" name="horaarribo" min="00:00:00" max="02:00:00" step="600"> --}}
            </div>

            <div class="form-group">
                <label for="txtFecha">Fecha</label>
                <div class="input-group">
                    <input type="text" class="form-control datepicker" name="txtFecha"  id="txtFecha">
                </div>
            </div>

            <div class="form-group">
                <label for="txtTerminoHora">Tiempo de  termino:</label>
                <input type="text" class="form-control" id="txtTerminoHora" name="txtTerminoHora" value="00:00:00" readonly>
                {{-- <input type="time" name="horaarribo" min="00:00:00" max="02:00:00" step="600"> --}}
            </div>

            <div class="form-group">
                <select class="custom-select" name="txtStatus" id="txtStatus">
                    <option selected>Status</option>
                    <option value="inicio">Aplicar tarea</option>
                    <option value="inicio">Pendiente</option>
                </select>
            </div>

            <button type="submit" class="btn btn-outline-primary">Submit</button>

       </form>
         </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secundary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>




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
                document.getElementById("hms").innerHTML = hAux + ":" + mAux + ":" + sAux;



                //  var asignar_hora = $('#asignar_hora').val();
                //  var tiempo_termino = $('#tiempo_termino').val();
                //  var fecha = $('#fecha').val();

                 //console.log("asignar "+ asignar_hora + " tiempo termino " +tiempo_termino +  " fecha " + fecha );





                return;



                if( hAux=='00' && mAux == '00' && sAux == '05'){
                   // alert("Hey jon");
                   console.log("Esto es a " + mAux+":"+sAux);
                   reiniciar();
                }




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


            $(document).ready(function(){

                        // Agregar la tarea tarea
                        // formulario
                        $("#addTarea").validate({
                        rules: {
                                txtDescripcion: "required",
                                txtTipo_duracion: "required",
                                txtAsignarHora: "required",
                                txtFecha: "required",
                                txtStatus:"required"
                            },
                            messages: {
                            },

                        submitHandler: function(form) {
                        var form_action = $("#addTarea").attr("action");
                        $.ajax({
                            data: $('#addTarea').serialize(),
                            url: form_action,
                            type: "POST",
                            dataType: 'json',
                            success: function (data) {

                                console.log("This is ",data);



                                var tarea = '<tr id="'+data.id+'">';

                                tarea += '<td>' + data.descripcion + '</td>';
                                tarea += '<td>' + data.tipo_duracion + '</td>';
                                tarea += '<td>' + data.asignar_hora + '</td>';
                                tarea += '<td>' + data.fecha + '</td>';
                                tarea += '<td>' + data.tiempo_termino + '</td>';
                                tarea += '<td>' + data.status + '</td>';
                                tarea += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Editar</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Eliminar</a></td>';
                                tarea += '</tr>';
                                $('#tareaTable tbody').prepend(tarea);
                                $('#addTarea')[0].reset();
                                $('#addModal').modal('hide');
                            },
                            error: function (data) {

                                console.log("Error", data);
                            }
                        });
                        }
	});





            })

// fecha
    $('.datepicker').datepicker({
        // format: "dd/mm/yyyy",

        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true
    });



</script>


@endsection
