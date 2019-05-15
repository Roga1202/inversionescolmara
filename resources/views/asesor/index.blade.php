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
                <th style="" class="text-center">Telefono</th>
                <th style="" class="text-center">Porcentaje de Ventas</th>
                <th style="" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asesores as $asesor)
                <tr class="table table-striped" style="size:auto;">
                    <td class="text-center">X</td>
                    <td class="text-center">{{ $asesor['AS_ID'] }}</td>
                    <td class="text-center">{{ $asesor['AS_nombre'] }}</td>
                    <td class="text-center">{{ $asesor['AS_telefono'] }}</td>
                    <td class="text-center">{{ $asesor['AS_porcentaje_ventas'] }} %</td>
                    <td class="text-center">
                      <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$asesor['AS_ID']}}')">Ver</button>
                      <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$asesor['AS_ID']}}')">Editar</button>
                      <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="fun_delete('{{$asesor['AS_ID']}}')">Borrar</button>
                    </td>
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
          <p><b>Nombre : </b><span id="view_nombre" class="text-success"></span></p>
          <p><b>Cedula : </b><span id="view_cedula" class="text-success"></span></p>
          <p><b>Grupo: </b><span id="view_grupo" class="text-success"></span></p>
          <p><b>Tipo: </b><span id="view_tipo" class="text-success"></span></p>
          <p><b>Direccion : </b><span id="view_direccion" class="text-success"></span></p>
          <p><b>Telefono : </b><span id="view_telefono" class="text-success"></span></p>
          <p><b>Telefono Emergencia : </b><span id="view_telefono_emergencia" class="text-success"></span></p>
          <p><b>Correo : </b><span id="view_correo" class="text-success"></span></p>
          <div id="visitas"><p><b>Visitas: </b><span id="view_visitas" class="text-success"></span></p></div>
          <div id="ventas_total"><p><b>Ventas total: </b><span id="view_ventas_total" class="text-success"></span></p></div>
          <div id="ventas_mes"><p><b>Ventas Mes: </b><span id="view_ventas_mes" class="text-success"></span></p></div>
          <div id="porcentaje"><p><b>Porcentaje ventas: </b><span id="view_porcentaje" class="text-success"></span></p></div>
          <p><b>Alias: </b><span id="view_alias" class="text-success"></span></p>
          <p><b>IMEI: </b><span id="view_IMEI" class="text-success"></span></p>
          <p><b>Registrado desde: </b><span id="view_inicio" class="text-success"></span></p>
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
<script src="{{ asset('assets/js/asesor.js') }}"></script>
@endsection