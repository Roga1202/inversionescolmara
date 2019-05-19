@extends('layouts.app')

@section('head')
  <link href="{{ asset('assets/css/error.css')}}" rel='stylesheet' type='text/css'>
  <link href="{{ asset('assets/css/archivo.css')}}" rel='stylesheet' type='text/css'>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection

@section('block')


@if (session('error_critico'))
  <div class="alert alert-danger" role="alert">
  <p>{{ session('error_critico') }}</p>
  </div>
@endif

@if(session('numero_errores'))
  @if (session('numero_errores') > 0)
    <div class="alert alert-danger" role="alert">
    @if (session('numero_errores') == 1)
      Numero de registros {{ session('numero_registros') }}.Se ha encontrado {{ session('numero_errores') }} error.
      <a style='cursor: pointer;' data-toggle="modal" data-target="#errorModal" class="boton_mostrar">Ver mas</a>
    </div>
    @else
      Numero de registros {{ session('numero_registros') }}.Se han encontrado {{ session('numero_errores') }} errores.
      <a style='cursor: pointer;' data-toggle="modal" data-target="#errorModal" class="boton_mostrar">Ver mas</a>
    </div>
    @endif
  @endif
@endif

@php
    if((session('notificacion') == True) && (session('numero_registros') > 0)){
      echo '<div class="alert alert-success" role="alert"> Numero de registros ' . session('numero_registros') . '. Se ha guardado todo con exito.';
    }
@endphp

<div class="col-sm-10" style="align:center;">

    <h2 class="page-header text-center">
        Clientes <span class="glyphicon glyphicon-user"></span>
    </h2>

    
      
    <div class="container">
        <form action="importar" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <label class="fileContainer">
              Presiona para Subir un archivo XlSX
              <input type="file" name="cliente" id="cliente" onchange="validar()" accept=".xlsx"/>
          </label>
          <label>
            <input type="submit" id="enviar" value="Enviar" class="btn btn-primary" disabled="disabled">
          </label>
        </form>
    </div>

    <div class="row">
      <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-offset-2 col-sm-8">
          <h3 class="text-center"> <small class="mensaje"></small></h3>
        </div>
        <div class="table-responsive col-sm-12">		
          <br>
          
          <table id="dt_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>								
                <th>ID</th>
                <th>Nombre</th>
                <th>Ref</th>
                <th>Visitas</th>
                <th>Compras</th>
                <th>Porcentaje Ventas</th>
                <th></th>											
              </tr>
            </thead>					
          </table>
        </div>			
      </div>		
    </div>

       
</div>

	<!-- View Modal start -->
  <div class="modal" id="viewModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">Ver</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p><b>ID : </b><span id="view_id" class="text-success"></span></p>
          <p><b>ID Geolocalizacion : </b><span id="view_id_geo" class="text-success"></span></p>
          <p><b>Nombre : </b><span id="view_nombre" class="text-success"></span></p>
          <p><b>Referencia : </b><span id="view_referencia" class="text-success"></span></p>
          <p><b>NIT : </b><span id="view_nit" class="text-success"></span></p>
          <p><b>Correo : </b><span id="view_correo" class="text-success"></span></p>
          <p><b>Grupo : </b><span id="view_grupo" class="text-success"></span></p>
          <p><b>Direccion: </b><span id="view_direccion" class="text-success"></span></p>
          <p><b>Descripcion : </b><span id="view_descripcion" class="text-success"></span></p>
          <p><b>Latitud: </b><span id="view_latitud" class="text-success"></span></p>
          <p><b>Longitud: </b><span id="view_longitud" class="text-success"></span></p>
          <p><b>Radio: </b><span id="view_radio" class="text-success"></span></p>
          <p><b>Color: </b><span id="view_color" class="text-success"></span></p>
          <p><b>Numero  de visitas: </b><span id="view_numero_visitas" class="text-success"></span></p>
          <div id="ultima_visita"><p><b>Ultima visita : </b><span id="view_ultima_visita" class="text-success"></span></p></div>
          <p><b>Numero de compras : </b><span id="view_numero_compras" class="text-success"></span></p>
          <div id="ultima_compra"><p><b>Ultima compra: </b><span id="view_ultima_compra" class="text-success"></span></p></div>
          <div id="porcentaje"><p><b>Porcenta de ventas: </b><span id="view_porcentaje" class="text-success"></span></p></div>
          <p><b>Registrado desde: </b><span id="view_inicio" class="text-success"></span></p>
        </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  
@if(session('numero_errores'))
  
<!-- Error Modal start -->
<div class="modal" id="errorModal" role="dialog">
    <div class="modal-lg modal-dialog">

    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">Errores</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          @php
              $i = 0;
          @endphp
          @foreach (session('errores') as $error)
            <p style="text-align:center;"><b>Error {{ $i+1 }}:</b>{{ $error }}</p>
            @php
                $i++;
            @endphp
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endif
  
  
@endsection
@section('script')
<script src="{{ asset('assets/js/cliente.js') }}"></script>
@endsection