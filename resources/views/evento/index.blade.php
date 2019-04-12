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
                    <form action="/evento/eliminar/{{$evento['CL_ID']}}" method="GET" >
                        {{ csrf_field() }}
                        <td class="text-center"> <a href="/evento/actualizar/{{$evento['CL_ID']}}" class="btn btn-info btn-sm">Actualizar</a> </td>
                        <td class="text-center"><button type="submit" class='btn btn-danger btn-sm'>Eliminar</button></td>
                    </form>    
                </tr>       
            @endforeach
        </tbody>
    </table>
</div>
@endsection