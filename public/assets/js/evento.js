function fun_view($id)
    {
      var view_url = '/evento/'+$id;
      $.ajax({
        url: view_url,
        type:'GET',
        datatype: 'json',
        async: true,
        success: function(result){
          const compra = document.querySelector('#view_compra');
          const deuda = document.querySelector('#view_deuda');
          const abono = document.querySelector('#view_abono');
          $("#view_id").text(result.EV_ID);
          $("#view_id_geo").text(result.EV_ID_GEO);
          $("#view_fecha").text(result.EV_fecha);
          $("#view_asesor").text(result.EV_asesor);
          $("#view_cliente").text(result.EV_cliente);
          $("#view_direccion").text(result.EV_direccion);
          $("#view_hora").text(result.EV_hora);
          $("#view_motivo").text(result.EV_motivo);
          if(result.EV_consolidacion == 1){
            
            compra.classList.remove('glyphicon','glyphicon-remove');
            compra.classList.add('glyphicon','glyphicon-ok');

            document.getElementById("comentario").style.display = "none";
          }else{
            compra.classList.remove('glyphicon','glyphicon-ok');
            
            compra.classList.add('glyphicon','glyphicon-remove');
            
            document.getElementById("comentario").style.display = "block";
            
            $("#view_comentario").text(result.EV_comentario_no_consolidacion);
          }
          if(result.EV_CL_cartera_vencida == 1){
            
            deuda.classList.remove('glyphicon','glyphicon-remove');
            deuda.classList.add('glyphicon','glyphicon-ok');
          }else{
            deuda.classList.remove('glyphicon','glyphicon-ok');
            deuda.classList.add('glyphicon','glyphicon-remove');
          }
          if(result.EV_abono == 1){

            abono.classList.remove('glyphicon','glyphicon-remove');
            abono.classList.add('glyphicon','glyphicon-ok');
            
            
            document.getElementById("tipo_pago").style.display = "block";
            document.getElementById("cantidad").style.display = "block";

            $("#view_tipo").text(result.EV_tipo_pago);
            $("#view_monto").text(result.EV_dinero_abono);
            
          }else{
            abono.classList.remove('glyphicon','glyphicon-ok');
            abono.classList.add('glyphicon','glyphicon-remove');
            
            
            document.getElementById("tipo_pago").style.display = "none";
            document.getElementById("cantidad").style.display = "none";
            
          }
          if (result.EV_fecha_proxima_cita != null) {

            $("#view_proxima").text(result.EV_fecha_proxima_cita);
            
            document.getElementById("proxima_cita").style.display = "block";
          }else{
            
            document.getElementById("proxima_cita").style.display = "none";
          }
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
    ],
    "language": idioma_espanol
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

