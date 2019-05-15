function fun_view($id)
    {
      var view_url = '/asesor/'+$id;
      $.ajax({
        url: view_url,
        type:'GET',
        datatype: 'json',
        async: true,
        success: function(result){
          $("#view_id").text(result.AS_ID);
          $("#view_nombre").text(result.AS_nombre);

          if (result.AS_cedula) {
            $("#view_cedula").text(result.AS_cedula);
          } else {
            $("#view_cedula").text("No posee cedula registrada");
          }

          $("#view_grupo").text(result.AS_grupo);

          if (result.AS_tipo) {
            $("#view_tipo").text(result.AS_tipo);
          } else {
            $("#view_tipo").text("No tiene tipo definido");
          }

          if (result.AS_direccion) {
            $("#view_direccion").text(result.AS_direccion);
          } else {
            $("#view_direccion").text("No posee direccion registrada");
          }
          
          if (result.AS_telefono) {
            $("#view_telefono").text(result.AS_telefono);
          } else {
            $("#view_telefono").text("No posee telefono registrado");
          }

          if (result.AS_telefono_emergencia) {
            $("#view_telefono_emergencia").text(result.AS_telefono_emergencia);
          } else {
            $("#view_telefono_emergencia").text("No posee telefono de emergencia registrado");
          }

          if (result.AS_correo) {
            $("#view_correo").text(result.AS_correo);
          } else {
            $("#view_correo").text("No posee correo registrado");
          }

          if (result.AS_visita != 0) {
            $("#view_visitas").text(result.AS_visita);

            if (result.AS_ventas_total != 0) {

              document.getElementById("ventas_total").style.display = "block";
              $("#view_ventas_total").text(result.AS_ventas_total);
              
            } else {
              document.getElementById("ventas_total").style.display = "none";
              $("#view_ventas_total").text("No posee ventas registradas");
            }
  
            if (result.AS_ventas_total_mes != 0) {

              $("#view_ventas_mes").text(result.AS_ventas_total_mes);
              document.getElementById("ventas_mes").style.display = "block";
            } else {

              document.getElementById("ventas_mes").style.display = "none";
              $("#view_ventas_mes").text("No posee ventas registradas");
            }
  
            if (result.AS_porcentaje_ventas != 0) {

              document.getElementById("porcentaje").style.display = "block";
              $("#view_porcentaje").text(result.AS_porcentaje_ventas + '%');
            } else {

              document.getElementById("porcentaje").style.display = "none";
              $("#view_porcentaje").text("No posee ventas registradas");
            }

          } else {
            $("#view_visitas").text("No posee visitas registradas");
          }
          
          if (result.AS_alias) {
            $("#view_alias").text(result.AS_alias);
          } else {
            $("#view_alias").text("No posee alias registrado");
          }
          
          if (result.AS_IMEI) {
            $("#view_IMEI").text(result.AS_IMEI);
          } else {
            $("#view_IMEI").text("No posee IMEI registrado");
          }

            $("#view_inicio").text(result.AS_inicio);

          
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