  function validar(){
    var input = document.getElementById("cliente");
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
    var table = $("#dt_cliente").DataTable({
      "ajax":{
        "headers": {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "method":"post",
        "url": "get_clientes",
        "dataSrc": "",
      },
      "columns":[
        {"data":"CL_ID"},
        {"data":"CL_nombre_completo"},
        {"data":"CL_referencia"},
        {"data":"CL_numero_visitas"},
        {"data":"CL_numero_compras"},
        {"data":"CL_porcentaje_ventas"},
        {"defaultContent":"<button class='ver btn btn-info'><i class='fa fa-eye'></i></button>"},
      ],
      "language": idioma_espanol
    });
     obter_data_editar("#dt_cliente tbody",table);
  }

  var obter_data_editar = function(tbody,table){
    $(tbody).on("click","button.ver", function(){
      $('#viewModal').modal('show');
      var data = table.row( $(this).parents("tr")).data();
      var idcliente = $("#view_id").text(data.CL_ID);
                      $("#view_id_geo").text(data.CL_ID_GEO);
                      $("#view_nombre").text(data.CL_nombre_completo);
                      
                      if (data.CL_referencia == null) {
                        $("#view_referencia").text("No posee");
                      } else {
                        $("#view_referencia").text(data.CL_referencia);
                      }
                      
                      if (data.CL_NIT == null) {
                        $("#view_nit").text("No se encuenta registrado");
                      }else{
                        $("#view_nit").text(data.CL_NIT); 
                      }
                      
                      if (data.CL_correo == null) {
                        $("#view_correo").text("No se encuenta registrado");
                      }else{
                        $("#view_correo").text(data.CL_correo); 
                      }
                      
                      $("#view_grupo").text(data.CL_grupo);
                      
                      $("#view_numero_visitas").text(data.CL_numero_visitas);
                      
                      if (data.CL_ultima_visita == null) {
                        
                        document.getElementById("ultima_visita").style.display = "none";
                        
                      } else {
                        
                        document.getElementById("ultima_visita").style.display = "block";
                        $("#view_ultima_visita").text(data.CL_ultima_visita);
                      }
                      
                      $("#view_numero_compras").text(data.CL_numero_compras);
                      
                      if (data.CL_numero_compras == 0) {
                        
                        document.getElementById("ultima_compra").style.display = "none";

                      } else {

                        document.getElementById("ultima_compra").style.display = "block";
                        $("#view_ultima_compra").text(data.CL_ultima_compra);

                      }
                      
                      $("#view_direccion").text(data.CL_direccion );
                      
                      if (data.CL_direccion_descripcion == null) {
                        $("#view_descripcion").text("No hay descripcion");
                      } else {
                        $("#view_descripcion").text(data.CL_direccion_descripcion);
                      }

                      if (data.CL_numero_compras == 0) {

                        document.getElementById("porcentaje").style.display = "none";

                      } else {
                        
                        document.getElementById("porcentaje").style.display = "block";

                        $("#view_porcentaje").text(data.CL_porcentaje_ventas + ' %');
                      }

                      $("#view_inicio").text(data.CL_inicio);

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
  
  