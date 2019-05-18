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

          $("#view_latitud").text(result.CL_latitud);
          $("#view_longitud").text(result.CL_longitud);
          $("#view_radio").text(result.CL_radio);

          switch (result.CL_color) {
            case "black":
              result.CL_color = "negro";
              break;
            case "blue":
              result.CL_color = "azul";
              break;
            case "green":
              result.CL_color = "verde";
              break;
            case "orange":
              result.CL_color = "naranja";
              break;
            case "pink":
              result.CL_color = "rosa";
              break;  
            case "purple":
              result.CL_color = "purpura";
              break;
            case "red":
              result.CL_color = "rojo";
              break;  
          }
          $("#view_color").text(result.CL_color);
          
          if (result.CL_numero_compras == 0) {

            document.getElementById("dinero_total").style.display = "none";
            document.getElementById("dinero_mes").style.display = "none";
            document.getElementById("porcentaje").style.display = "none";

          } else {
            
            document.getElementById("dinero_total").style.display = "block";
            document.getElementById("dinero_mes").style.display = "block";
            document.getElementById("porcentaje").style.display = "block";

            $("#view_dinero_total").text(result.CL_dinero_total);
            $("#view_dinero_mes").text(result.CL_dinero_mes);
            $("#view_porcentaje").text(result.CL_porcentaje_ventas + ' %');
          }

          if (result.CL_dinero_deuda == 0) {
            $("#view_deuda").text("No posee deudas");         
          } else {
            $("#view_deuda").text(result.CL_dinero_deuda);
          }

          $("#view_inicio").text(result.CL_inicio);

        }
      });
    }
 
    function fun_edit($id)
    {
      var view_url = '/cliente/'+$id;
      $.ajax({
        url: view_url,
        type:'GET',
        datatype: 'json',
        async: true,
        success: function(result){

          $("#edit_ID").val(result.CL_ID);

          $("#edit_nombre").val(result.CL_nombre_completo);

          $("#edit_referencia").val(result.CL_referencia);

          $("#edit_NIT").val(result.CL_NIT); 
    
          $("#edit_direccion").val(result.CL_direccion);
          
        }
      });
    }
    
    // updated a post
  
    $('.modal-footer').on('click', '.updated', function() {
      var id = $("#edit_ID").val();
      var referencia = $("#edit_referencia").val();
      var nit = $("#edit_NIT").val();
      var direccion = $("#edit_direccion").val();
      $.ajax({
          type: "GET",
          url: 'cliente/actualizar/' + id,
          data: {referencia:referencia,nit:nit,direccion:direccion},
          success: function(data) {
            alert("Cliente actualizado con exito");
          },
        }).fail( function(jxXHR,textStatus,errorThrown){
          alert("No se pudo guardar el cliente , revise los valores");
      });
    });

    function fun_delete($id)
    {
        var view_url = '/cliente/'+$id;
        $.ajax({
          url: view_url,
          type:'GET',
          datatype: 'json',
          async: true,
          success: function(result){

          $("#ID").val(result.CL_ID);

          $("#nombre").val(result.CL_nombre_completo);

          if (result.CL_referencia == null) {
            $("#referencia").val("No posee");
          } else {
            $("#referencia").val(result.CL_referencia);
          }

          $("#direccion").val(result.CL_direccion);
          }
        });
      } 

  // delete a post
  
  $('.modal-footer').on('click', '.delete', function() {
    var conf = confirm("Al borrar al cliente borraras sus eventos tambien. Estas seguro de realizar esta acción?");
    if(conf){
      var id = $("#ID").val();
      $.ajax({
          type: 'delete',
          url: 'cliente/eliminar/' + id,
          data: {
              '_token': $('input[name=_token]').val(),
          },
          success: function(data) {
            location.reload();
          }
      });
    }
  });

  function validar(){
    var input = document.getElementById("cliente");
    if(input.value != ""){
        document.getElementById("enviar").disabled = "";  
    }else{
      document.getElementById("enviar").disabled = "disabled"; 
    }
  }
