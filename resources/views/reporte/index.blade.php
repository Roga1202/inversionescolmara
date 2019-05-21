@extends('layouts.app')

@section('head')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection

@section('block')

<div class="col-sm-10" style="align:center;">

    <h2 class="page-header text-center">
        Reporte</span>
    </h2>

    <h2 class="page-header text-center">
        Asesores <span class="glyphicon glyphicon-user"></span>
    </h2>

    <div class="row">
      <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-offset-2 col-sm-8">
          <h3 class="text-center"> <small class="mensaje"></small></h3>
        </div>
        <div class="table-responsive col-sm-12">		
          <br>
          
          <table id="dt_reporte_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Visitas</th>
                <th>Ventas</th>
                <th>Porcentaje Ventas</th>										
                <th>Porcentaje Visitas</th>										
                <th>Acciones</th>											
              </tr>
            </thead>
            <tbody>
                    @foreach ($data['asesor'] as $asesor)
                        <tr class="table table-striped" style="size:auto;">
                            <td class="text-center">{{ $asesor['AS_ID'] }}</td>
                            <td class="text-center">{{ $asesor['AS_nombre'] }}</td>
                            <td class="text-center">{{ $asesor['AS_visita'] }}</td>
                            <td class="text-center">{{ $asesor['AS_ventas_total'] }}</td>
                            <td class="text-center">{{ $asesor['AS_porcentaje_ventas'] }} %</td>
                            <td class="text-center">{{ $asesor['AS_porcentaje_visitas'] }} %</td>
                            <td class="text-center">
                                {{-- <button cla  ss="btn btn-info" data-toggle="modal" data-target="#viewCliente" onclick="fun_view ('{{$asesor['AS_ID']}}')">Ver</button> --}}
                                <button class="btn btn-info" data-toggle="modal" data-target="#viewModalAsesor" onclick="fun_view_asesor('{{$asesor['AS_ID']}}')">Eventos</button>
                              </td>
                        </tr>
                    @endforeach
                </tbody>				
          </table>
        </div>			
      </div>		
    </div>

    <h2 class="page-header text-center">
        Clientes <span class="glyphicon glyphicon-user"></span>
    </h2>
    
    <div class="row">
      <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-offset-2 col-sm-8">
          <h3 class="text-center"> <small class="mensaje"></small></h3>
        </div>
        <div class="table-responsive col-sm-12">		
          <br>
          
          <table id="dt_reporte_cliente" class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ref</th>
                <th>Visitas</th>
                <th>Compras</th>
                <th>Porcentaje Ventas</th>
                <th>Acciones</th>											
              </tr>
            </thead>
            <tbody>
                    @foreach ($data['cliente'] as $cliente)
                        <tr class="table table-striped" style="size:auto;">
                            <td class="text-center">{{ $cliente['CL_ID'] }}</td>
                            <td class="text-center">{{ $cliente['CL_nombre_completo'] }}</td>
                            <td class="text-center">{{ $cliente['CL_referencia'] }}</td>
                            <td class="text-center">{{ $cliente['CL_numero_visitas'] }}</td>
                            <td class="text-center">{{ $cliente['CL_numero_compras'] }}</td>
                            <td class="text-center">{{ $cliente['CL_porcentaje_ventas'] }} %</td>
                            <td class="text-center">
                                <button class="btn btn-info" data-toggle="modal" data-target="#viewModalCliente" onclick="fun_view_cliente('{{$cliente['CL_ID']}}')">Ver</button>
                              </td>
                        </tr>
                    @endforeach
                </tbody>				
          </table>
        </div>			
      </div>		
    </div>
   
</div>

	<!-- View Modal start -->
  <div class="modal" id="viewModalAsesor" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">Ver</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          <div class="modal-body">
            <div name="eventos">

            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  	<!-- View Modal start -->
    <div class="modal" id="viewModalCliente" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center">Ver</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <div class="modal-body">
                <div name="eventos_cliente">
    
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- <!-- View Modal start -->
    <div class="modal" id="viewCliente" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center">Vser</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
              <div class="modal-body">
                <div name="eventos_cliente">
    
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default cerrarModal" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div> --}}


  
  
@endsection
@section('script')
<script>
    var data = <?php echo json_encode($data); ?>;
</script>
<script src="{{ asset('assets/js/reporte.js') }}"></script>
@endsection