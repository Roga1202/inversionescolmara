@extends('layouts.app')


@section('block')

<div class="container">
    <div class="row">
        <div class="col-md-9" style="align:center;">
            <h2 class="page-header">
                Asesores <span class="glyphicon glyphicon-user"></span>
            </h2>


            <table class="table table-striped" style="size:auto;">
                <thead>
                    <tr>
                        <th style="" class="text-center">ID</th>
                        <th style="" class="text-center">Nombre</th>
                        <th style="" class="text-center">C.I</th>
                        <th style="" class="text-center">Actualizar</th>
                        <th style="" class="text-center">Eliminar</th>

                    </tr>
                </thead>
                <tbody>
                @foreach ($asesores as $asesor)
                    <tr class="table table-striped" style="size:auto;">
                        <td class="text-center">{{ $asesor['AS_ID'] }}</td>
                        <td class="text-center">{{ $asesor['AS_nombre'] }}</td>
                        <td class="text-center">{{ $asesor['AS_cedula'] }}</td>
                        <form action="/asesor/eliminar/{{$asesor['AS_ID']}}" method="GET" >
                        {{ csrf_field() }}
                        <td class="text-center"> <a href="/asesor/actualizar/{{$asesor['AS_ID']}}" class="btn btn-info btn-sm">Actualizar</a> </td>

                        <td class="text-center"><button type="submit" class='btn btn-danger btn-sm'>Eliminar</button></td>
                        </form>
                   
                    </tr>
                        
            @endforeach
                </tbody>

            </table>
            @if (count($asesores))
        <div class="mt-2 mx-auto">
            {{ $asesores->links('pagination::bootstrap-4') }}    
        </div>
        @endif
          
        </div>
        
    </div>
    
</div>

@endsection