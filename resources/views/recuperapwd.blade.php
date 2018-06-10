<link href="{{ asset('css/telenetestilos.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ URL::asset('js/jstelenet.js') }}"></script>
@extends('telenetmain')

@section('cuerpo')
  <form method="post" action="">
    Ingrese Correo:
    <input type="email" name="email" class="enfocable"><br>
    <input type="submit" value="Enviar" disabled>
    <input type="reset"  value="limpiar" onclick="enfoca()">
    <a href="{{ url('/') }}">Volver...</a>
  </form>
@endsection
