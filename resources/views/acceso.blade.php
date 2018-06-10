<link href="{{ asset('css/telenetestilos.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ URL::asset('js/jstelenet.js') }}"></script>

@extends('telenetmain')


@section('cuerpo')
<div class="divcon">
  <form method="post" action="{{ url('accesasite') }}" >
    {{ csrf_field() }}
    Usuario:
    <input name="usuario" type="text" autofocus class="enfocable"> <br><br>
    Password:
    <input name="password" type="password"><br><br>
    <input type="submit" value="Enviar">
    <input type="reset" onclick="enfoca()" value="Limpiar">
  </form>
  <a href="{{ url('recuperarpwd') }}">Olvido sus datos...</a><br><br>
  <button type="button" name="button" onclick="autoregv()">Registrarse...</button>
</div>
<div class="divcon" id="autoregd" style="visibility:hidden">
  <form id="autoregf" class="" action="{{ url('/registrausuario') }}" method="post">
    {{ csrf_field() }}
    <table class="tablajus" id="autoregt">
      <tr>
        <th colspan="2" style="text-align:center">Registro de Usuarios</th>
      </tr>
      <tr>
        <td>Nombre Completo:</td>
        <td>
          <input type="text" name="nombre" maxlehingth="128" class="enfocable">
        </td>
      </tr>
      <tr>
        <td>Usuario:</td>
        <td>
          <input type="text" name="usuario" maxlength="32">
        </td>
      </tr>
      <tr>
        <td>Clave:</th>
        <td>
          <input type="password" name="pwd" maxlength="16">
        </td>
      </tr>
      <tr>
        <td>Inserte Email:</td>
        <td>
          <input type="email" name="email1" id="email1" maxlength="256" class="enfocable">
        </td>
      </tr>
      <tr>
        <td>Confirme Email:</td>
        <td>
          <input type="email" name="email2" id="email2" maxlength="256">
        </td>
      </tr>
      <tr>
        <td>
          <input type="button" id="enviar" name="enviar" value="Registrar" onclick="validar()" class="enfocable">
        </td>
        <td>
          <button type="button" name="button" onclick="autoregi()">Cancelar</button>
        </td>
      </tr>
    </table>

  </form>
</div>
@endsection
