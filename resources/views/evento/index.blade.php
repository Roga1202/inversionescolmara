@extends('layouts.app')


@section('block')
<div class="col-sm-10" style="align:center;">
    <h2 class="page-header text-center">
        Eventos <span class="glyphicon glyphicon-user"></span>
    </h2>
    <table class="table table-striped" style="size:auto;">
        <thead>
            <tr>
                <th style="" class="text-center">Completo</th>
                <th style="" class="text-center">ID</th>
                <th style="" class="text-center">Nombre</th>
                <th style="" class="text-center">C.I</th>
                <th style="" class="text-center">Ver</th>
                <th style="" class="text-center">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventos as $evento)
                <tr class="table table-striped" style="size:auto;">
                    <td class="text-center">{{ $evento['EV_ID'] }}</td>
                    <td class="text-center">{{ $evento['EV_asesor'] }}</td>
                    <td class="text-center">{{ $evento['EV_cliente'] }}</td>
                    <td class="text-center"><button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info btn-sm">Ver</button> </td>
                    <td class="text-center"><button type="submit" class='btn btn-danger btn-sm'>Eliminar</button></td>  
                </tr>       
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')

<script>
$(".cerrarModal").click(function(){
  $("#modal").modal('hide')
});
</script>
@endsection