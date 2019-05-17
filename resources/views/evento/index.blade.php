@extends('layouts.app')


@section('block')
<div class="col-sm-10 container" style="align:center;">
    <h2 class="page-header text-center">
        Eventos <span class="glyphicon glyphicon-user"></span>
    </h2>

    
<div class="col-sm-10">
  <form action="importar" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <h3 class="text-center">Asesor</h3>
    <input name="asesor" id="asesor" class="form-control" accept="xlsx" type="file"/>
    <h3 class="text-center">Cliente</h3>
    <input name="cliente" id="cliente" class="form-control" accept="xlsx" type="file"/>
    <h3 class="text-center">Formulario Rutero Mayor</h3>
    <input name="evento" id="evento" class="form-control" accept="xlsx" type="file"/>
    <input type="submit" class="btn btn-primary" value="Guardar">
  </form>
</div>

    <div class="container">
        <table class="table table-striped" style="size:auto;">
            <thead>
                <tr>
                    <th style="" class="text-center">ID</th>
                    <th style="" class="text-center">Asesor</th>
                    <th style="" class="text-center">Cliente</th>
                    <th style="" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="cuerpo">
                @foreach ($eventos as $evento)
                    <tr class="table table-striped" style="size:auto;">
                        <td class="text-center" name="id" id="id">{{ $evento['EV_ID'] }}</td>
                        <td class="text-center">{{ $evento['EV_asesor'] }}</td>
                        <td class="text-center">{{ $evento['EV_cliente'] }}</td>
                        <td class="text-center">
                        <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$evento['EV_ID']}}')">Ver</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="fun_delete('{{$evento['EV_ID']}}')">Borrar</button>
                        </td>
                    </tr>       
                @endforeach
            </tbody>
        </table>
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
    
@endsection
@section('script')
  <script src="{{ asset('assets/js/evento.js') }}"></script>
@endsection