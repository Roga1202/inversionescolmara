@extends('layouts.app')

@section('head')
  <link href="{{ asset('assets/css/archivo.css')}}" rel='stylesheet' type='text/css'>
  <link href="{{ asset('assets/css/error.css')}}" rel='stylesheet' type='text/css'>
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
      echo '<div class="alert alert-success" role="alert"> Numero de registros ' . session('numero_registros')  . '. Se ha guardado todo con exito.';
    }
@endphp


<div class="col-sm-10 container" style="align:center;">
    <h2 class="page-header text-center">
        Eventos <span class="glyphicon glyphicon-user"></span>
    </h2>
    
    <div class="container">
        <form action="importar" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <label class="fileContainer">
              Presiona para Subir un archivo XlSX
              <input type="file" name="evento" id="evento" onchange="validar()" accept=".xlsx"/>
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
            
            <table id="dt_evento" class="table table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr>								
                  <th>ID</th>
                  <th>Asesor</th>
                  <th>Cliente</th>
                  <th>Fecha</th>
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
            <p><b>Fecha : </b><span id="view_fecha" class="text-success"></span></p>
            <p><b>Asesor : </b><span id="view_asesor" class="text-success"></span></p>
            <p><b>Cliente : </b><span id="view_cliente" class="text-success"></span></p>
            <p><b>Direccion : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Hora de visita : </b><span id="view_hora" class="text-success"></span></p>
            <p><b>Motivo de visita: </b><span id="view_motivo" class="text-success"></span></p>
            <p><b>Compra : </b><span id="view_compra" class="text-success"></span></p>
            <div id="comentario"><p><b>Comentario : </b><span id="view_comentario" class="text-success"></span></p></div>
            <p><b>Deuda cliente : </b><span id="view_deuda" class="text-success"></span></p>
            <p><b>Abono : </b><span id="view_abono" class="text-success"></span></p>
            <div id="tipo_pago"><p><b>Tipo de pago : </b><span id="view_tipo" class="text-success"></span></p></div>
            <div id="cantidad"><p><b>Cantidad : </b><span id="view_monto" class="text-success"></span></p></div>
            <div id="proxima_cita"><p><b>Proxima Visita : </b><span id="view_proxima" class="text-success"></span></p></div>
          </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    <!-- view modal ends -->

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
<script src="{{ asset('assets/js/evento.js') }}"></script>
@endsection