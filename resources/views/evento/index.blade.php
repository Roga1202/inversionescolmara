@extends('layouts.proceso')

@section('head')
    <link href="{{ asset('assets/css/archivo.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/botones.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/error.css')}}" rel='stylesheet' type='text/css'>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection
  
  @section('block')

<div class="col-sm-10 container" style="align:center;">
    <h2 class="page-header text-center">
      Eventos <span class="glyphicon glyphicon-user"></span>
    </h2>
    
    <div class="row">
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
        <button type="button" class="reporte btn btn-danger" style="position:relative;left:40%">Crear reporte</button>
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
            <div name="evento">
              <p><b>ID : </b><span id="view_id" ></span></p>
              <p><b>ID Geolocalizacion : </b><span id="view_id_geo" ></span></p>
              <p><b>Fecha : </b><span id="view_fecha" ></span></p>
              <p><b>Asesor : </b><span id="view_asesor" ></span></p>
              <p><b>Cliente : </b><span id="view_cliente" ></span></p>
              <p><b>Direccion : </b><span id="view_direccion" ></span></p>
              <p><b>Hora de visita : </b><span id="view_hora" ></span></p>
              <p><b>Motivo de visita: </b><span id="view_motivo" ></span></p>
              <p><b>Compra : </b><span id="view_compra" ></span></p>
              <div id="comentario"><p><b>Comentario : </b><span id="view_comentario" ></span></p></div>
              <p><b>Deuda cliente : </b><span id="view_deuda" ></span></p>
              <p><b>Abono : </b><span id="view_abono" ></span></p>
              <div id="tipo_pago"><p><b>Tipo de pago : </b><span id="view_tipo" ></span></p></div>
              <div id="cantidad"><p><b>Cantidad : </b><span id="view_monto" ></span></p></div>
              <div id="proxima_cita"><p><b>Proxima Visita : </b><span id="view_proxima" ></span></p></div>
            </div>
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
      
      <!-- View Modal start -->
      <div class="modal" id="reporteModal" role="dialog">
        <div class="modal-dialog">
          
      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-center">Reporte</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        <div class="modal-body">
          <form action="reporte" method="get">
            {{csrf_field()}}
        <div class="asesores">
          <label>Asesores:</label>
          <select multiple name="asesores[]"  id="asesores[]"></select>
        </div>
        <br>
        <br>
        <div class="clientes">
          <label>Clientes:</label>
          <select multiple name="clientes[]" id="clientes[]"></select>
        </div>
        <br>
        <br>
        <div class="grupos">
          <label>Grupos:</label>
          <select multiple name="grupos[]" id="grupos[]"></select>
        </div>
        <br>
        <br>
        <div class="fecha">
          <label>Desde</label>  
          <div class="form-group">
              <div class='input-group date' id='datetimepicker6'>
                  <input type='text' name="desde" class="form-control" />
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
          <div class="form-group">
            <label>Hasta</label>
            <div class='input-group date' id='datetimepicker7'>
              <input type='text' name="hasta" class="form-control" />
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
              </span>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Generar</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
  <!-- view modal ends -->
  
  @endsection

  @section('datepicker')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  @endsection

  @section('bootstrap_datepicker')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css"> 
  @endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script>
  $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
  });

  $("select").select2({
    width:'100%'
  });

  $( function(){
    $('select[name="clientes[]"]').on('change', function(){
        var disabled = $(this).val() == null ? false : true;
        $('select[name="grupos[]"]').prop('disabled', disabled);
        });
    });
    

  $( function(){
    $('select[name="grupos[]"]').on('change', function(){
        var disabled = $(this).val() == null ? false : true;
        $('select[name="clientes[]"]').prop('disabled', disabled);
        });
    });

  $(function() {
    $('#datetimepicker1').datetimepicker();
  });


  $(function () {
          $('#datetimepicker6').datetimepicker({
              viewMode: 'years',
              format: 'YYYY-MM-DD'
          });
      });
      

  $(function () {
          $('#datetimepicker7').datetimepicker({
              viewMode: 'years',
              format: 'YYYY-MM-DD'
          });
      });

  $(function () {

    $('#datetimepicker6').datetimepicker();
    $('#datetimepicker7').datetimepicker({
        useCurrent: false //Important! See issue #1075
    });

    $("#datetimepicker6").on("dp.change", function (e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });

    $("#datetimepicker7").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
    
  });
</script>
<script src="{{ asset('assets/js/evento.js') }}"></script>
@endsection