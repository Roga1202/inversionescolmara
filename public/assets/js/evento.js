function fun_view($id)
    {
      var view_url = '/evento/'+$id;
      $.ajax({
        url: view_url,
        type:'GET',
        datatype: 'json',
        async: true,
        success: function(result){
        }
      });
    }

function validar(){
  var input = document.getElementById("evento");
  if(input.value != ""){
      document.getElementById("enviar").disabled = "";  
  }else{
    document.getElementById("enviar").disabled = "disabled"; 
  }
}

$(document).on("ready",function(){
  listar();
});

var listar = function(){
  var table = $("#dt_evento").DataTable({
    "ajax":{
      "headers": {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      "method":"post",
      "url": "get_evento",
      "dataSrc": "",
    },
    "columns":[
      {"data":"EV_ID"},
      {"data":"EV_asesor"},
      {"data":"EV_cliente"},
      {"data":"EV_fecha"},
      {"defaultContent":"<button class='ver btn btn-info'><i class='fa fa-eye'></i></button>"},
    ],
    "language": idioma_espanol
  });
  obter_data_editar("#dt_evento tbody",table);
}

var obter_data_editar = function(tbody,table){
  $(tbody).on("click","button.ver", function(){
    $('#viewModal').modal('show');
    var data = table.row( $(this).parents("tr")).data();
    var idevento =  $("#view_id").text(data.EV_ID);
                    const compra = document.querySelector('#view_compra');
                    const deuda = document.querySelector('#view_deuda');
                    const abono = document.querySelector('#view_abono');
                    $("#view_id_geo").text(data.EV_ID_GEO);
                    $("#view_fecha").text(data.EV_fecha);
                    $("#view_asesor").text(data.EV_asesor);
                    $("#view_cliente").text(data.EV_cliente);
                    $("#view_direccion").text(data.EV_direccion);
                    $("#view_hora").text(data.EV_hora);
                    $("#view_motivo").text(data.EV_motivo);
                    if(data.EV_consolidacion == 1){
                      
                      compra.classList.remove('glyphicon','glyphicon-remove');
                      compra.classList.add('glyphicon','glyphicon-ok');

                      document.getElementById("comentario").style.display = "none";
                    }else{
                      compra.classList.remove('glyphicon','glyphicon-ok');
                      
                      compra.classList.add('glyphicon','glyphicon-remove');
                      
                      document.getElementById("comentario").style.display = "block";
                      
                      $("#view_comentario").text(data.EV_comentario_no_consolidacion);
                    }
                    if(data.EV_CL_cartera_vencida == 1){
                      
                      deuda.classList.remove('glyphicon','glyphicon-remove');
                      deuda.classList.add('glyphicon','glyphicon-ok');
                    }else{
                      deuda.classList.remove('glyphicon','glyphicon-ok');
                      deuda.classList.add('glyphicon','glyphicon-remove');
                    }
                    if(data.EV_abono == 1){

                      abono.classList.remove('glyphicon','glyphicon-remove');
                      abono.classList.add('glyphicon','glyphicon-ok');
                      
                      
                      document.getElementById("tipo_pago").style.display = "block";
                      document.getElementById("cantidad").style.display = "block";

                      $("#view_tipo").text(data.EV_tipo_pago);
                      $("#view_monto").text(data.EV_dinero_abono);
                      
                    }else{
                      abono.classList.remove('glyphicon','glyphicon-ok');
                      abono.classList.add('glyphicon','glyphicon-remove');
                      
                      
                      document.getElementById("tipo_pago").style.display = "none";
                      document.getElementById("cantidad").style.display = "none";
                      
                    }
                    if (data.EV_fecha_proxima_cita != null) {

                      $("#view_proxima").text(data.EV_fecha_proxima_cita);
                      
                      document.getElementById("proxima_cita").style.display = "block";
                    }else{
                      
                      document.getElementById("proxima_cita").style.display = "none";
                    }

  });
}

var idioma_espanol = {
  "sProcessing":     "Procesando...",
  "sLengthMenu":     "Mostrar _MENU_ registros",
  "sZeroRecords":    "No se encontraron resultados",
  "sEmptyTable":     "Ningún dato disponible en esta tabla",
  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  "sInfoPostFix":    "",
  "sSearch":         "Buscar:",
  "sUrl":            "",
  "sInfoThousands":  ",",
  "sLoadingRecords": "Cargando...",
  "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
  },
  "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
  }
}

