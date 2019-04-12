@extends('layouts.app')


@section('block')

<div class="col-sm-10" style="align:center;">
    <h2 class="page-header text-center">
        Asesores <span class="glyphicon glyphicon-user"></span>
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
            @foreach ($asesores as $asesor)
                <tr class="table table-striped" style="size:auto;">
                    <td class="text-center">X</td>
                    <td class="text-center">{{ $asesor['AS_ID'] }}</td>
                    <td class="text-center">{{ $asesor['AS_nombre'] }}</td>
                    <td class="text-center">{{ $asesor['AS_cedula'] }}</td>
                    <form action="/asesor/eliminar/{{$asesor['AS_ID']}}" method="GET" >
                        {{ csrf_field() }}
                        <td class="text-center"> <a data-toggle="modal" href="#cliente" class="btn btn-info btn-sm">Ver</a> </td>
                        <td class="text-center"><button type="submit" class='btn btn-danger btn-sm'>Eliminar</button></td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="portfolio-modal modal fade" id="cliente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="close-modal" data-dismiss="modal">
        <div class="lr">
          <div class="rl"></div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-8 mx-auto">
            <div class="modal-body">
              <!-- Project Details Go Here -->
              <h2 class="text-uppercase">ACDelco</h2>
              <p class="item-intro text-muted"></p>
              <img class="img-fluid d-block mx-auto" src="img/marcas/ACDELCO.png" alt="ACDelco informaciòn">
              <p>ACDelco es reconocido como líder de calidad mundial en el mercado de Autopartes de Posventa, al ofrecer partes de reemplazo Premium para prácticamente todos los vehículos.
                Durante más de 100 años ACDelco ha innovado y fijado los estándares en la industria automotriz a través de su línea de productos y de un servicio de la más alta calidad. Sus productos incluyen:
              </p>
              <ul>

                <li>Bombas de agua</li>
                <li>Kit de clutch</li>
                <li> Kit de tiempo </li>
                <li>  Refrigerantes</li>
                <li>Cables de Bujías</li>
                <li> Tensores y Poleas</li>
                <li>Bombas de Gasolina</li>
                <li>Cepillos Limpiabrisas</li>
                <li>Bujias de pllatino e iridio</li>
                <li>Pastillas y bandas de frenos</li>
                <li>Correas de tiempo y principales</li>
                <li>Filtros de Aire, Aceite y gasolina</li>
                <li>Empaques de Motor, tapa valvula y cámara</li>
     
              </ul>
              <button class="btn btn-primary" data-dismiss="modal" type="button">
                <i class="fas fa-times"></i>
              Cerrar Información sobre esta Marca</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection