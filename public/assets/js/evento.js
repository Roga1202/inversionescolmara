
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
    "language": idioma_espanol,
  });
  ver("#dt_evento tbody",table);
}

var ver = function(tbody,table){
  const div = document.querySelector('div[name="evento"]');
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
                      div.setAttribute('class','text-success');
                      compra.classList.remove('glyphicon','glyphicon-remove');
                      compra.classList.add('glyphicon','glyphicon-ok');

                      document.getElementById("comentario").style.display = "none";
                    }else{
                      div.setAttribute('class','text-danger');
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

$(document).on("click","button.reporte", function(){
  $('#reporteModal').modal('show');
  
  $.ajax({
    url: 'reporte',
    type:'post',
    datatype: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(result){
      const asesores = result.asesor;
      const clientes = result.cliente;
      const grupos = result.grupo;

      const list_asesores = document.querySelector('select[name="asesores[]"]');
      const list_clientes = document.querySelector('select[name="clientes[]"]');
      const list_grupos = document.querySelector('select[name="grupos[]"]');

      if(asesores != null){
        asesores.forEach((asesor) => {
          var opcion = document.createElement('option');
          opcion.setAttribute('value',asesor.AS_ID);
          var textopcion = document.createTextNode(asesor.AS_nombre); // Ocualquiera que necesites mostrar
          opcion.appendChild(textopcion);
          list_asesores.appendChild(opcion);
        });
      }else{
        var opcion = document.createElement('option');
        var textopcion = document.createTextNode("No hay asesores registrados"); // Ocualquiera que necesites mostrar
        opcion.appendChild(textopcion);
        list_asesores.appendChild(opcion);
      }



      if(clientes != null){
        clientes.forEach((cliente) => {
          var opcion = document.createElement('option');
          opcion.setAttribute('value',cliente.CL_ID);
          var textopcion = document.createTextNode(cliente.CL_nombre_completo); // Ocualquiera que necesites mostrar
          opcion.appendChild(textopcion);
          list_clientes.appendChild(opcion);
        });
      }else{
        var opcion = document.createElement('option');
        var textopcion = document.createTextNode("No hay clientes registrados"); // Ocualquiera que necesites mostrar
        opcion.appendChild(textopcion);
        list_clientes.appendChild(opcion);
      }

      if(grupos != null){
        grupos.forEach((grupo) => {
          var opcion = document.createElement('option');
          opcion.setAttribute('value',grupo);
          var textopcion = document.createTextNode(grupo); // Ocualquiera que necesites mostrar
          opcion.appendChild(textopcion);
          list_grupos.appendChild(opcion);
        });
      }else{
        var opcion = document.createElement('option');
        var textopcion = document.createTextNode("No hay grupos registrados"); // Ocualquiera que necesites mostrar
        opcion.appendChild(textopcion);
        list_grupos.appendChild(opcion);
      }


      $("#reporteModal").on("hidden.bs.modal", function () {
        while (list_asesores.lastChild) {
          list_asesores.removeChild(list_asesores.lastChild);
        } 
        while (list_clientes.lastChild) {
          list_clientes.removeChild(list_clientes.lastChild);
        } 
        while (list_grupos.lastChild) {
          list_grupos.removeChild(list_grupos.lastChild);
        }
      });
    }
  });
});



