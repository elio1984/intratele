<link href="{{ asset('css/telenetestilos.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ url('js/jstelenet.js') }}"></script>
@extends('telenetmain')
@section('cuerpo')
  <script type="text/javascript">
  function buscapro() {
    var fd=0;
    var jsarr = <?php  echo json_encode($producto); ?>;
    for (var i = 0; i < jsarr.length; i++) {
      if (jsarr[i].idepro==document.getElementById('idepro').value) {
          document.getElementById('nompro').value=jsarr[i].nompro;
          document.getElementById('prepro').value=jsarr[i].prepro;
          fd=1;
    }
    }
    if (fd==0) {
      document.getElementById('nompro').value="";
      document.getElementById('prepro').value="";
    }
  }
  </script>
  <a href="{{ url('/amenu') }}">Menu</a>
  <form class="" action="{{ url('guardaoferta') }}" method="post">
    {{csrf_field()}}
    <table>
      <tr>
        <th colspan="2" style="align:center">Insertar Oferta</th>
      </tr>
      <tr>
        <td>ID:</td>
        <td>
          <input type="text" id="idepro" name="idepro">
          <button type="button" id="buscar" onclick="buscapro()">Buscar</button>
        </td>
      </tr>
      <tr>
        <td>Nombre:</td>
        <td>
          <input type="text" id="nompro" name="nompro" value="" maxlength="256">
        </td>
      </tr>
      <tr>
        <td>Precio Convenio:</td>
        <td>
          <input type="text" id="prepro" name="prepro" value="">
        </td>
      </tr>
      <tr>
        <td>Fecha Inicial:</td>
        <td>
          <input type="date" id="feciniof" name="feciniof" value="">
        </td>
      </tr>
      <tr>
        <td>Fecha Final:</td>
        <td>
          <input type="date" id="fecfinof" name="fecfinof" value="">
        </td>
      </tr>
      <tr>
        <td>Precio Oferta:</td>
        <td>
          <input type="number" id="preofe" name="preofe" value="" step="0.01">
        </td>
      </tr>
      <tr>
        <td>Costo:</td>
        <td>
          <input type="number" id="costo" name="costo" value="" step="0.01">
        </td>
      </tr>
      <tr>
        <td>Margen:</td>
        <td>
          <input type="number" id="margen" onfocus="calcmargen()" name="margen" value="" step="0.01">
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" name="" value="Guardar">
        </td>
        <td>
          <button type="button" name="" onclick="limpiaof()">Cancelar</button>
        </td>
      </tr>

    </table>
    <br><br>
    <table>
      <tr>
        <th>ID de Producto</th>
        <th>Fecha Inicio</th>
        <th>Fecha Final</th>
        <th>Precio Oferta</th>
        <th>Costo Neto</th>
        <th>Margen Diferencia</th>
      </tr>
      @foreach ($ofertas as $ofertas1)
        <tr>
          <td>
            <button type="button" id="{{ $ofertas1 -> idepro }}" onclick="detofe()">{{$ofertas1 -> idepro}}</button>
          </td>
          <td>{{ $ofertas1 -> feciniof }}</td>
          <td>{{ $ofertas1 -> fecfinof }}</td>
          <td>{{ $ofertas1 -> preofe }}</td>
          <td>{{ $ofertas1 -> costo }}</td>
          <td>{{ $ofertas1 -> margen }}</td>
        </tr>
      @endforeach
    </table>
  </form>
  <a href="{{ url('/amenu') }}">Menu</a>
@endsection
