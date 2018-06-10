@extends ('telenetmain')

@section ('cuerpo')
  @switch($caso)
    @case(1)
    <h3>registro Exitoso!</h3>
    <a href="{{ url('/') }}">Acceso...</a>
    @break
    @case(2)
    <h3>Exsiste oferta con ID y rango de fechas relacionadas!</h3>
    <a href="{{ url('/ofertas') }}">Volver...</a>
    {{ $reg }}
    @break
    @case(3)
    <h3>Oferta registrada con exito!</h3>
    <a href="{{ url('/ofertas') }}">Volver...</a>
    @break
  @endswitch
@endsection
