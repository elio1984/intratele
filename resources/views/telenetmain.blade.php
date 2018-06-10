<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intranet de Telenet</title>
    <link rel="shortcut icon" href="{{ asset('favicon-6.ico') }}">
    <link href="{{ asset('css/telenetestilos.css') }}" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div class="usuario">
      <?php
        if(\Session::has('user')){
            echo "| Bienvenido: ".\Session::get('user').
            " | Dolar Observado: ".\Session::get('valdolar'). "CLP.".
            " | Mayorista: ".\Session::get('observado')."CLP. |";
        }
      ?>
    </div>
    <div id="divlogo">
      <?php
      if (\Session::has('user')){
      ?>
        <a href="{{ url('/amenu') }}"><img id="logo" src="{{ asset('logo-telenet-sitio-web.png') }}" alt="TELENET"></a>
      <?php
      }else{
      ?>
        <a href="{{ url('/') }}"><img id="logo" src="{{ asset('logo-telenet-sitio-web.png') }}" alt="TELENET"></a>
      <?php
      }
      ?>

    </div>
    <div id="divtit">
    <h1>COMERCIALIZADORA TELENET LTDA</h1> <br><br>
    </div>
    @yield('cuerpo')
  </body>
</html>
