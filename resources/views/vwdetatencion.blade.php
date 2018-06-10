<link href="{{ asset('css/telenetestilos.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ URL::asset('js/jstelenet.js') }}"></script>

@extends('telenetmain')


@section('cuerpo')
<div id="divcon">
  <form method="post" action="{{ url('guardate') }}">
    {{csrf_field()}}
    <table class="tablajus">
      <tr>
        <th>Codigo Atencion:</th>
        <td><input type="text" name="codate" id="codate" value="{{$detate[0]->codate}}" readonly></td>
      </tr>
      <tr>
        <th>
          Medio de Contacto:
        </th>
        <td>
          @foreach ($medate as $medate1)
            @if ($medate1 -> codaso==$detate[0]->medate)
              <input type="radio" id="medate" name="medate" value="{{$medate1 -> codaso}}" checked>{{$medate1 -> codaso.".".$medate1 -> valor}}<br>
            @else
              <input type="radio" id="medate" name="medate" value="{{$medate1 -> codaso}}">{{$medate1 -> codaso.".".$medate1 -> valor}}<br>
            @endif
          @endforeach
        </td>
      </tr>
      <tr>
        <th>Persona que contacta:</th>
        <td>
          <input list="lperate" name="perate" value="{{$detate[0]->perate}}">
          <datalist id="lperate">
              <option value="seleccione">
            @foreach ($perate as $perate1)
              <option value="{{$perate1 -> nombren}}">
            @endforeach
          </datalist>
        </td>
      </tr>
      <tr>
        <th>Entidad de Origen:</th>
        <td>
          <input list="loriate" name="oriate" value="{{$detate[0]->oriate}}">
          <datalist id="loriate">
              <option value="seleccione">
            @foreach ($oriate as $oriate1)
              <option value="{{$oriate1 -> nombrej}}">
            @endforeach
          </datalist>
        </td>
      </tr>
      <tr>
        <th>
          Codigo de Origen:
        </th>
        <td>
          @foreach ($pubpri as $pubpri1)
            @if ($pubpri1 -> codaso==$detate[0]->pubpri)
              <input type="radio" id="pubpri" name="pubpri" value="{{$pubpri1 -> codaso}}" checked>{{$pubpri1 -> codaso.".".$pubpri1 -> valor}}<br>
            @else
              <input type="radio" id="pubpri" name="pubpri" value="{{$pubpri1 -> codaso}}">{{$pubpri1 -> codaso.".".$pubpri1 -> valor}}<br>
            @endif
          @endforeach
        </td>
      </tr>
      <tr>
        <th>Atencion Inicial:</th>
        <td><input type="text" name="ateate" value="{{$detate[0]->ateate}}" readonly></td>
      </tr>
      <tr>
        <th>Asunto:</th>
        <td><textarea name="asunto" id="asunto" onfocus="ubica()" rows="8" cols="80" resize="none">{{print_r($detate[0]->asunto)}}</textarea></td>
      </tr>
      <tr>
        <th>Fono Contacto:</th>
        <td><input type="text" name="fono" value="{{$detate[0]->fono}}" maxlength="9"></td>
      </tr>
      <tr>
        <th>Movil Contacto:</th>
        <td><input type="text" name="movil" value="{{$detate[0]->movil}}" maxlength="9"></td>
      </tr>
      <tr>
        <th>Email de Contacto:</th>
        <td><input type="email" name="email" value="{{$detate[0]->email}}" maxlength="256"></td>
      </tr>
      <tr>
        <th>Fecha/Hora:</th>
        <td><input type="text" name="cuando" value="{{$detate[0]->cuando}}" readonly></td>
      </tr>
      <tr>
        <th>Estado de Atencion:</th>
        <td>
          @foreach ($abierto as $abierto1)
            @if ($abierto1 -> codaso==$detate[0]->abierto)
              <input type="radio" id="abierto" name="abierto" value="{{$abierto1 -> codaso}}" checked>{{$abierto1 -> codaso.".".$abierto1 -> valor}}<br>
            @else
              <input type="radio" id="abierto" name="abierto" value="{{$abierto1 -> codaso}}">{{$abierto1 -> codaso.".".$abierto1 -> valor}}<br>
            @endif
          @endforeach
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="guarda" value="Guardar"><a href="{{ url('/atenciones') }}">Volver</a></td>
      </tr>
    </table>
    {{\Session::put('perate',$perate)}}
    {{\Session::put('oriate',$oriate)}}
  </form>
</div>
@endsection
