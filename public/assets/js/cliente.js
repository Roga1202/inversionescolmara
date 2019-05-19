function fun_view($id)
    {
      var view_url = '/cliente/'+$id;
      $.ajax({
        url: view_url,
        type:'GET',
        datatype: 'json',
        async: true,
        success: function(result){
          $("#view_id").text(result.CL_ID);
          $("#view_id_geo").text(result.CL_ID_GEO);
          $("#view_nombre").text(result.CL_nombre_completo);
          
          if (result.CL_referencia == null) {
            $("#view_referencia").text("No posee");
          } else {
            $("#view_referencia").text(result.CL_referencia);
          }
          
          if (result.CL_NIT == null) {
            $("#view_nit").text("No se encuenta registrado");
          }else{
            $("#view_nit").text(result.CL_NIT); 
          }
          
          if (result.CL_correo == null) {
            $("#view_correo").text("No se encuenta registrado");
          }else{
            $("#view_correo").text(result.CL_correo); 
          }
          
          $("#view_grupo").text(result.CL_grupo);
          
          $("#view_numero_visitas").text(result.CL_numero_visitas);
          
          if (result.CL_ultima_visita == null) {
            
            document.getElementById("ultima_visita").style.display = "none";
            
          } else {
            
            document.getElementById("ultima_visita").style.display = "block";
            $("#view_ultima_visita").text(result.CL_ultima_visita);
          }
          
          $("#view_numero_compras").text(result.CL_numero_compras);
          
          if (result.CL_numero_compras == 0) {
            
            document.getElementById("ultima_compra").style.display = "none";

          } else {

            document.getElementById("ultima_compra").style.display = "block";
            $("#view_ultima_compra").text(result.CL_ultima_compra);

          }
          
          $("#view_direccion").text(result.CL_direccion );
          
          if (result.CL_direccion_descripcion == null) {
            $("#view_descripcion").text("No hay descripcion");
          } else {
            $("#view_descripcion").text(result.CL_direccion_descripcion);
          }

          if (result.CL_numero_compras == 0) {

            document.getElementById("porcentaje").style.display = "none";

          } else {
            
            document.getElementById("porcentaje").style.display = "block";

            $("#view_porcentaje").text(result.CL_porcentaje_ventas + ' %');
          }

          $("#view_inicio").text(result.CL_inicio);

        }
      });
    }

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
  
  