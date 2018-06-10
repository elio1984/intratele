<link href="{{ asset('css/telenetestilos.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ url('js/jstelenet.js') }}"></script>
@extends('telenetmain')
@section('cuerpo')
<div id="divcon">
  <h3>Control de LLamadas</h3>
  <form method="post" action="{{ url('/detallaate') }}" >
    {{ csrf_field() }}
    <input type="text" name="codate" id="codate">
    <input type="submit" name="buscar" value="Buscar" class="enfocable">
    <input type="submit" name="nuevo" value="Nueva Atencion" onclick="dispara()" class="gatillo">
    <br>
    <br>
      <table class="tablacen">
        <thead>
          <tr>
            <th>ID Atención</th>
            <th>Persona</th>
            <th>Origen</th>
            <th>Atencion inicial</th>
            <th>Asunto</th>
            <th>Movil</th>
            <th>Email</th>
            <th>Cuando</th>
          </tr>
        </thead>
      <?php
        foreach ($atenciones as $aten) {
      ?>
      <tr>
        <td><input type="button" onclick="asigate({{$aten -> codate}})" id="{{$aten -> codate}}" value="{{$aten -> codate}}" resize="none"></td>
        <td>{{$aten -> perate}}</td>
        <td>{{$aten -> oriate}}</td>
        <td>{{$aten -> ateate}}</td>
        <td>
          <textarea rows="1" cols="50" disabled>{{$aten -> asunto}}</textarea>
        </td>
        <td>{{$aten -> movil}}</td>
        <td>{{$aten -> email}}</td>
        <td>{{$aten -> cuando}}</td>
      </tr>
      <?php  # code...
      }
     ?>
     </table>
  </form>
  <a href="{{ url('/amenu') }}">Menu</a>
</div>
@endsection
