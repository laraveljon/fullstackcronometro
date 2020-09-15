
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cronometro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

     <!-- Bootstrap CSS -->
     {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> --}}

       <!-- Jquery -->
       {{-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script> --}}
       <!-- Datepicker Files -->
       <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
       <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">
       <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
       <!-- Languaje -->
       <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

</body>

    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
    @font-face{
        font-family:alarm;
        src:url("/images/recursosEnunciado/alarm.ttf");
    }
    .cronometro{
       width:200px;
        height:100px;
        left:50%;
        text-align:center;
    }
    .boton{display:inline-block;width:32px;height:32px;position:relative;}
    #hms{
        height:68px;
        padding:5px 0;
        font-size:50px;
        color:rgb(194, 141, 27);
        font-family: alarm;
     }
        .start{background:url("/images/recursosEnunciado/start.png") 0 0 no-repeat;}
        .stop{background:url("/images/recursosEnunciado/pause.png") 0 0 no-repeat;}
        .reiniciar{background:url("/images/recursosEnunciado/delete.png")0 0 no-repeat;}

    .sinborde{
        border: 0;
    }
    </style>

</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
