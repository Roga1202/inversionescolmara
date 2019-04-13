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
                    <td class="text-center">{{ $evento['EV_ID'] }}</td>
                    <td class="text-center">{{ $evento['EV_asesor'] }}</td>
                    <td class="text-center">{{ $evento['EV_cliente'] }}</td>
                    <td>
                      <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="">Ver</button>
                      <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="">Editar</button>
                      <button class="btn btn-danger" onclick="">Borrar</button>
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
            <h4 class="modal-title text-center">View</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <p><b>ID Geolocalizacion : </b><span id="view_id" class="text-success"></span></p>
            <p><b>Fecha : </b><span id="view_nombre" class="text-success"></span></p>
            <p><b>Asesor : </b><span id="view_apellido" class="text-success"></span></p>
            <p><b>Cliente : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Direccion : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Hora de visita : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Motivo de visita: </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Compra : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Comentario : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Deuda cliente : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Abono : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Tipo de pago : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Cantidad : </b><span id="view_direccion" class="text-success"></span></p>
            <p><b>Proxima Visita : </b><span id="view_direccion" class="text-success"></span></p>
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
<script>
$(".cerrarModal").click(function(){
  $("viewModal").modal('hide')
});
</script>
@endsection