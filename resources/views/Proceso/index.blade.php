@extends('layouts.app')
@section('head')
  <title>Colmara Ltda</title>
@endsection
@section('block')
@if(session('numero_errores'))
  @if (session('numero_errores') > 0)
    <div class="alert alert-danger" role="alert">
      @if (session('numero_errores') == 1)
        Numero de registros {{ session('numero_registros') }}.Se ha encontrado {{ session('numero_errores') }} error.
      @else
        Numero de registros {{ session('numero_registros') }}.Se han encontrado {{session('numero_errores') }} errores. 
      @endif
    </div>
  @else
    <div class="alert alert-success" role="alert">
        Numero de registros {{ session('numero_registros') }}.Se ha guardado todo con exito.
    </div>     
  @endif
@endif
<br>
<br>
<br>
<br>
<br>
<div class="col-sm-10">
  <form action="importar" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="asesor" id="asesor" class="form-control" accept="xlsx" type="file"/>
    <input name="cliente" id="cliente" class="form-control" accept="xlsx" type="file"/>
    <input name="evento" id="evento" class="form-control" accept="xlsx" type="file"/>
    <input type="submit" class="btn btn-primary" value="Guardar">
  </form>
</div>

@endsection
