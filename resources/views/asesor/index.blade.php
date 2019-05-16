@extends('layouts.app')


@section('block')

<div class="col-sm-10" style="align:center;">
    <h2 class="page-header text-center">
        Asesores <span class="glyphicon glyphicon-user"></span>
    </h2>
    <table class="table table-striped" style="size:auto;">
        <thead>
            <tr>
                <th style="" class="text-center">ID</th>
                <th style="" class="text-center">Nombre</th>
                <th style="" class="text-center">Ventas</th>
                <th style="" class="text-center">Visitas</th>
                <th style="" class="text-center">Porcentaje Ventas</th>
                <!-- <th style="" class="text-center">Ventas del mes</th> -->
                <th style="" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asesores as $asesor)
                <tr class="table table-striped" style="size:auto;">
                    <td class="text-center">{{ $asesor['AS_ID'] }}</td>
                    <td class="text-center">{{ $asesor['AS_nombre'] }}</td>
                    <td class="text-center">{{ $asesor['AS_ventas_total'] }}</td>
                    <td class="text-center">{{ $asesor['AS_visita'] }}</td>
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

  <!-- Edit Modal start -->
  <div class="modal" id="editModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Editar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="evento/actualizar" method="POST">
                {{ csrf_field() }}
                <div class="form-group">

                    <input type="hidden" class="form-control" id="edit_ID" name="edit_ID">

                    <div class="form-group">
                        <label for="edit_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="edit_nombre" name="edit_nombre" disabled>
                    </div>

                    <div class="form-group">
                        <label for="edit_cedula">Cedula:</label>
                        <input type="text" class="form-control" id="edit_cedula" name="edit_cedula">
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_tipo">Tipo:</label>
                        <input type="text" min="0" class="form-control" id="edit_tipo" name="edit_tipo">
                    </div>

                    <div class="form-group">
                        <label for="edit_direccion">Direccion:</label>
                        <input type="text" class="form-control" id="edit_direccion" name="edit_direccion">
                    </div>

                    <div class="form-group">
                        <label for="edit_telefono">Telefono:</label>
                        <input type="number" class="form-control" id="edit_telefono" name="edit_telefono">
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_telefono_emergencia">Telefono Emergencia:</label>
                        <input type="number" class="form-control" id="edit_telefono_emergencia" name="edit_telefono_emergencia">
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_correo">Correo:</label>
                        <input type="email" class="form-control" id="edit_correo" name="edit_correo">
                    </div>

                    <div class="form-group">
                        <label for="edit_IMEI">IMEI:</label>
                        <input type="number" class="form-control" id="edit_IMEI" name="edit_IMEI">
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_alias">Alias:</label>
                        <input type="text" class="form-control" id="edit_alias" name="edit_alias">
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-default updated" data-dismiss="modal">Modificar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
          </div>
          
        </div>
      </div>
      <!-- Edit code ends -->



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
                        <label class="control-label col-sm-2" for="title">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nombre" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Alias:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="alias" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                          <label class="control-label col-sm-2" for="title">Telefono:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="telefono" disabled>
                          </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger delete" data-dismiss="modal">
                        <span class='glyphicon glyphicon-trash'></span> Delete
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
<script src="{{ asset('assets/js/asesor.js') }}"></script>
@endsection