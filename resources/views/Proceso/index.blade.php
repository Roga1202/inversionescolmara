@extends('layouts.app')
@section('head')
  <title>Colmara Ltda</title>
@endsection
@section('block')
  @if ($numero_errores)
    @if ($numero_errores > 0)
      <div class="alert alert-danger" role="alert">
        @if ($numero_errores == 1)
          Numero de registros {{ $numero_registros }}.Se ha encontrado {{ $numero_errores }} error.
        @else
          Numero de registros {{ $numero_registros }}.Se han encontrado {{$numero_errores }} errores. 
        @endif
      </div>
    @else
      <div class="alert alert-success" role="alert">
          Numero de registros {{ $numero_registros }}.Se ha guardado todo con exito.
      </div>     
    @endif
  @endif
@endsection
