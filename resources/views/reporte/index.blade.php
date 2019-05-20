@extends('layouts.app')

@section('head')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection

@section('block')

<div class="col-sm-10" style="align:center;">

    <h2 class="page-header text-center">
        Reporte</span>
    </h2>

    <h2 class="page-header text-center">
        Asesores <span class="glyphicon glyphicon-user"></span>
    </h2>

    <div class="row">
      <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-offset-2 col-sm-8">
          <h3 class="text-center"> <small class="mensaje"></small></h3>
        </div>
        <div class="table-responsive col-sm-12">		
          <br>
          
          <table id="dt_reporte_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
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
            <tbody>
                    @foreach ($data['asesor'] as $asesor)
                        <tr class="table table-striped" style="size:auto;">
                            <td class="text-center">{{ $asesor['AS_ID'] }}</td>
                            <td class="text-center">{{ $asesor['AS_nombre'] }}</td>
                            <td class="text-center">{{ $asesor['AS_visita'] }}</td>
                            <td class="text-center">{{ $asesor['AS_ventas_total'] }}</td>
                            <td class="text-center">{{ $asesor['AS_porcentaje_ventas'] }} %</td>
                            <td class="text-center">
                              <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$asesor['AS_ID']}}')">Ver</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>				
          </table>
        </div>			
      </div>		
    </div>

    <h2 class="page-header text-center">
        Clientes <span class="glyphicon glyphicon-user"></span>
    </h2>
    
    <div class="row">
      <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-offset-2 col-sm-8">
          <h3 class="text-center"> <small class="mensaje"></small></h3>
        </div>
        <div class="table-responsive col-sm-12">		
          <br>
          
          <table id="dt_reporte_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ref</th>
                <th>Visitas</th>
                <th>Compras</th>
                <th>Porcentaje Ventas</th>
                <th>Acciones</th>											
              </tr>
            </thead>
            <tbody>
                    @foreach ($data['cliente'] as $cliente)
                        <tr class="table table-striped" style="size:auto;">
                            <td class="text-center">{{ $cliente['CL_ID'] }}</td>
                            <td class="text-center">{{ $cliente['CL_nombre_completo'] }}</td>
                            <td class="text-center">{{ $cliente['CL_referencia'] }}</td>
                            <td class="text-center">{{ $cliente['CL_numero_visitas'] }}</td>
                            <td class="text-center">{{ $cliente['CL_numero_compras'] }}</td>
                            <td class="text-center">{{ $cliente['CL_porcentaje_ventas'] }} %</td>
                            <td class="text-center">
                              <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$cliente['AS_ID']}}')">Ver</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>				
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
  
  
@endsection
@section('script')
<script>
    var data = <?php echo json_encode($data); ?>;
    console.log(data);
</script>
<script src="{{ asset('assets/js/cliente.js') }}"></script>
@endsection