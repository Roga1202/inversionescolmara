@extends('layouts.proceso')

@section('head')
    <link href="{{ asset('assets/css/error.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/botones.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/archivo.css')}}" rel='stylesheet' type='text/css'>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection


@section('block')

<div class="col-sm-10" style="align:center;">
      <h2 class="page-header text-center">
          Asesores <span class="glyphicon glyphicon-user"></span>
      </h2>
      
      <div class="row">
          <form action="importar" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label class="fileContainer">
                Presiona para Subir un archivo XlSX
                <input type="file" name="asesor" id="asesor" onchange="validar()" accept=".xlsx"/>
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
            
            <table id="dt_asesor" class="table table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr>								
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Visitas</th>
                  <th>Ventas</th>
                  <th>Porcentaje Ventas</th>											
                  <th>Acciones</th>											
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
          <p><b>Nombre : </b><span id="view_nombre" class="text-success"></span></p>
          <p><b>Cedula : </b><span id="view_cedula" class="text-success"></span></p>
          <p><b>Grupo: </b><span id="view_grupo" class="text-success"></span></p>
          <p><b>Tipo: </b><span id="view_tipo" class="text-success"></span></p>
          <p><b>Direccion : </b><span id="view_direccion" class="text-success"></span></p>
          <p><b>Telefono : </b><span id="view_telefono" class="text-success"></span></p>
          <p><b>Telefono Emergencia : </b><span id="view_telefono_emergencia" class="text-success"></span></p>
          <p><b>Correo : </b><span id="view_correo" class="text-success"></span></p>
          <div id="visitas"><p><b>Visitas: </b><span id="view_visitas" class="text-success"></span></p></div>
          <div id="ventas_total"><p><b>Ventas total: </b><span id="view_ventas_total" class="text-success"></span></p></div>
          <div id="ventas_mes"><p><b>Ventas Mes: </b><span id="view_ventas_mes" class="text-success"></span></p></div>
          <div id="porcentaje"><p><b>Porcentaje ventas: </b><span id="view_porcentaje" class="text-success"></span></p></div>
          <p><b>Alias: </b><span id="view_alias" class="text-success"></span></p>
          <p><b>IMEI: </b><span id="view_IMEI" class="text-success"></span></p>
          <p><b>Registrado desde: </b><span id="view_inicio" class="text-success"></span></p>
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


<!-- view  evento Modal start -->
<div class="modal" id="eventoModal" role="dialog">
  <div class="modal-lg modal-dialog">

  <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Eventos</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div name="eventos"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  
@section('script')
<script src="{{ asset('assets/js/asesor.js') }}"></script>
@endsection