@extends('layouts.app')


@section('block')
<div class="col-sm-10" style="align:center;">
    <h2 class="page-header text-center">
        Eventos <span class="glyphicon glyphicon-user"></span>
    </h2>
    <table class="table table-striped" style="size:auto;">
        <thead>
            <tr>
                <th style="" class="text-center">ID</th>
                <th style="" class="text-center">Asesor</th>
                <th style="" class="text-center">Cliente</th>
                <th style="" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
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

    <!--eliminar un registro-->
    <div id="deleteModal" class="modal" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                  <h3 class="text-center">Estas seguro que quieres eliminar el evento?</h3>
                  <br />
                  <form class="form-horizontal" action="evento/eliminar" method="DELETE">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <label class="control-label col-sm-2" for="id">ID:</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" id="ID" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-2" for="title">Asesor:</label>
                          <div class="col-sm-10">
                              <input type="name" class="form-control" id="asesor" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-2" for="title">Cliente:</label>
                          <div class="col-sm-10">
                              <input type="name" class="form-control" id="cliente" disabled>
                          </div>
                      </div>
                      <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Fecha:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fecha" disabled>
                            </div>
                      </div>
                  </form>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-danger delete" data-dismiss="modal">
                          <span id="" class='glyphicon glyphicon-trash'></span> Delete
                      </button>
                      <button type="button" class="btn btn-warning" data-dismiss="modal">
                          <span class='glyphicon glyphicon-remove'></span> Close
                      </button>
                  </div>
              </div>
          </div>
      </div>
  </div>
    
@endsection
@section('script')
  <script src="{{ asset('assets/js/evento.js') }}"></script>
@endsection