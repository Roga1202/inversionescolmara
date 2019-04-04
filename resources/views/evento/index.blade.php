@extends('layouts.app')


@section('block')

<div class="container">
    <div class="row">
        <div class="col-md-9" style="align:center;">
            <h2 class="page-header">
                Eventos <span class="glyphicon glyphicon-user"></span>
            </h2>


            <table class="table table-striped" style="size:auto;">
                <thead>
                    <tr>
                        <th style="" class="text-center">ID</th>
                        <th style="" class="text-center">Asesor</th>
                        <th style="" class="text-center">Cliente</th>
                        <th style="" class="text-center">Actualizar</th>
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
            @if (count($eventos))
        <div class="mt-2 mx-auto">
            {{ $eventos->links('pagination::bootstrap-4') }}    
        </div>
        @endif
          
        </div>
        
    </div>
    
</div>

@endsection