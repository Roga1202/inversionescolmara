@extends('layouts.app')


@section('block')

@if ($errors)
    @foreach ($errors as $error)
        <div class="invalid-feedback">{{ $error }}</div>   
    @endforeach
@endif

<div class="col-sm-10" style="align:center;">
    <h2 class="page-header text-center">
        Clientes <span class="glyphicon glyphicon-user"></span>
    </h2>
    <table class="table table-striped" style="size:auto;">
        <thead>
            <tr>
                <th style="" class="text-center">ID</th>
                <th style="" class="text-center">Nombre</th>
                <th style="" class="text-center">Ref</th>
                <th style="" class="text-center">Visitas</th>
                <th style="" class="text-center">Compras</th>
                <th style="" class="text-center">Porcentaje Ventas</th>
                <th style="" class="text-center">Dinero total</th>
                <th style="" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr class="table table-striped" style="size:auto;">
                    <td class="text-center">{{ $cliente['CL_ID'] }}</td>
                    <td class="text-center" width="3">{{ $cliente['CL_nombre_completo'] }}</td>
                    <td class="text-center">{{ $cliente['CL_referencia'] }}</td>
                    <td class="text-center">{{ $cliente['CL_numero_visitas'] }}</td>
                    <td class="text-center">{{ $cliente['CL_numero_compras'] }}</td>
                    <td class="text-center">{{ $cliente['CL_porcentaje_ventas'] }} %</td>
                    <td class="text-center">{{ $cliente['CL_dinero_total'] }}</td>
                    <td class="text-center">
                      <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$cliente['CL_ID']}}')">Ver</button>
                     </td>
                </tr>
            @endforeach
        </tbody>
    </table>   
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
          <div id="dinero_total"><p><b>Dinero total: </b><span id="view_dinero_total" class="text-success"></span></p></div>
          <div id="dinero_mes"><p><b>Dinero del mes: </b><span id="view_dinero_mes" class="text-success"></span></p></div>
          <p><b>Deuda: </b><span id="view_deuda" class="text-success"></span></p>
          <div id="porcentaje"><p><b>Porcenta de ventas: </b><span id="view_porcentaje" class="text-success"></span></p></div>
          <p><b>Registrado desde: </b><span id="view_inicio" class="text-success"></span></p>
        </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script src="{{ asset('assets/js/cliente.js') }}"></script>
@endsection