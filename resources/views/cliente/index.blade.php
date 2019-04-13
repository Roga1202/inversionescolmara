@extends('layouts.app')


@section('block')

<div class="col-sm-10" style="align:center;">
    <h2 class="page-header text-center">
        Clientes <span class="glyphicon glyphicon-user"></span>
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
            @foreach ($clientes as $cliente)
                <tr class="table table-striped" style="size:auto;">
                    <td class="text-center">x</td>
                    <td class="text-center">{{ $cliente['CL_ID'] }}</td>
                    <td class="text-center">{{ $cliente['CL_nombre_completo'] }}</td>
                    <td class="text-center">{{ $cliente['CL_credencial'] }}</td>
                    <td class="text-center"><button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info btn-sm">Ver</button> </td>
                    <td class="text-center"><button type="submit" class='btn btn-danger btn-sm'>Eliminar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>   
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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