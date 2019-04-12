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
                    <form action="/cliente/eliminar/{{$cliente['CL_ID']}}" method="GET" >
                    {{ csrf_field() }}
                    <td class="text-center"> <a href="/cliente/actualizar/{{$cliente['CL_ID']}}" class="btn btn-info btn-sm">Actualizar</a> </td>
                    <td class="text-center"><button type="submit" class='btn btn-danger btn-sm'>Eliminar</button></td>
                    </form>        
                </tr>
            @endforeach
        </tbody>
    </table>   
</div>
@endsection