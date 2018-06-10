<link href="{{ asset('css/telenetestilos.css') }}" rel="stylesheet" type="text/css">
@extends('telenetmain')

@section('cuerpo')
<div id="divcon">
  <h3>Menu de Opciones</h3>
  <nav>
    <ul>
      <a href="{{ url('/atenciones') }}"> Atenciones| </a>
      <a href="{{ url('/ordenes') }}"> Ordenes de Compra Proveedores|</a>
      <a href="{{ url('/cotizaciones') }}"> Seguimiento de Cotizaciones|</a>
      <a href="{{ url('/ofertas') }}"> Registro de Ofertas </a>
    </ul>
  </nav>
  <a href="{{ url('/salida') }}">Salir</a>
</div>
@endsection
