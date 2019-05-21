    function validar(){
      var input = document.getElementById("asesor");
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
    var table = $("#dt_asesor").DataTable({
      "ajax":{
        "headers": {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "method":"post",
        "url": "get_asesores",
        "dataSrc": "",
      },
      "columns":[
        {"data":"AS_ID"},
        {"data":"AS_nombre"},
        {"data":"AS_visita"},
        {"data":"AS_ventas_total"},
        {"data":"AS_porcentaje_ventas"},
        {"defaultContent":"<button class='ver btn btn-info'><i class='fa fa-eye'></i></button><button class='eventos btn btn-warning'><i class='fa fa-expand'></i></button>"},
      ],
      "language": idioma_espanol,
    });
     ver("#dt_asesor tbody",table);
  }
  
  var ver = function(tbody,table){
    $(tbody).on("click","button.ver", function(){
      $('#viewModal').modal('show');
      var data = table.row( $(this).parents("tr")).data();
      var idasesor = $("#view_id").text(data.AS_ID);
                     $("#view_nombre").text(data.AS_nombre);

                    if (data.AS_cedula) {
                      $("#view_cedula").text(data.AS_cedula);
                    } else {
                      $("#view_cedula").text("No posee cedula registrada");
                    }

                    $("#view_grupo").text(data.AS_grupo);

                    if (data.AS_tipo) {
                      $("#view_tipo").text(data.AS_tipo);
                    } else {
                      $("#view_tipo").text("No tiene tipo definido");
                    }

                    if (data.AS_direccion) {
                      $("#view_direccion").text(data.AS_direccion);
                    } else {
                      $("#view_direccion").text("No posee direccion registrada");
                    }
                    
                    if (data.AS_telefono) {
                      $("#view_telefono").text(data.AS_telefono);
                    } else {
                      $("#view_telefono").text("No posee telefono registrado");
                    }

                    if (data.AS_telefono_emergencia) {
                      $("#view_telefono_emergencia").text(data.AS_telefono_emergencia);
                    } else {
                      $("#view_telefono_emergencia").text("No posee telefono de emergencia registrado");
                    }

                    if (data.AS_correo) {
                      $("#view_correo").text(data.AS_correo);
                    } else {
                      $("#view_correo").text("No posee correo registrado");
                    }

                    if (data.AS_visita) {
                      $("#view_visitas").text(data.AS_visita);
                    } else {
                      $("#view_visitas").text("No posee visitas registradas");
                    }

                    if (data.AS_ventas_total) {
                      $("#view_ventas_total").text(data.AS_ventas_total);
                    } else {
                      $("#view_ventas_total").text("No posee ventas registradas");
                    }

                    if (data.AS_ventas_total_mes) {
                      $("#view_ventas_mes").text(data.AS_ventas_total_mes);
                      document.getElementById("ventas_mes").style.display = "block";
                    } else {
                      document.getElementById("ventas_mes").style.display = "none";
                      $("#view_ventas_mes").text("No posee ventas registradas");
                    }

                    if (data.AS_porcentaje_ventas) {
                      document.getElementById("porcentaje").style.display = "block";
                      $("#view_porcentaje").text(data.AS_porcentaje_ventas  + ' %');
                    } else {
                      document.getElementById("porcentaje").style.display = "none";
                      $("#view_porcentaje").text("No posee ventas registradas");
                    }
                    
                    if (data.AS_alias) {
                      $("#view_alias").text(data.AS_alias);
                    } else {
                      $("#view_alias").text("No posee alias registrado");
                    }
                    
                    if (data.AS_IMEI) {
                      $("#view_IMEI").text(data.AS_IMEI);
                    } else {
                      $("#view_IMEI").text("No posee IMEI registrado");
                    }

                      $("#view_inicio").text(data.AS_inicio);
    });
    
    $(tbody).on("click","button.eventos", function(){
      $('#eventoModal').modal('show');
      var data = table.row( $(this).parents("tr")).data();
      var id = data.AS_ID;
      $.ajax({
        url: 'evento/asesor/'+ id,
        type:'get',
        datatype: 'json',
        success: function(result){
          const elements = result;
          const list = document.querySelector('div[name="eventos"]');
          var i = 0;
          if (elements == '') {
            const _ = document.createElement('h2');
            const textElement = document.createTextNode("No tiene ningun evento registrado"); // Ocualquiera que necesites mostrar
            _.appendChild(textElement);
            
            list.appendChild(_);
            $("#eventoModal").on("hidden.bs.modal", function () {
              while (list.lastChild) {
                list.removeChild(list.lastChild);
              }
            });
          }else{
            elements.forEach((element) => {
              i+=1;
              
              var d = document.createElement("div");
              d.setAttribute("id", "div"+i);
              list.appendChild(d);


              
              const evento = document.createElement('p');
              const textinfo = document.createTextNode("Evento " + element.EV_ID); // Ocualquiera que necesites mostrar
              evento.appendChild(textinfo);
              d.appendChild(evento);
              
              const compra = document.createElement('p');
              var span = document.createElement('span');
              
              if(element.EV_consolidacion == 1){
                span.setAttribute("class", "glyphicon glyphicon-ok");
                d.setAttribute('class','text-success');
              }else{
                span.setAttribute("class", "glyphicon glyphicon-remove");
                d.setAttribute('class','text-danger');
              }
              const textcompra = document.createTextNode("Compra:"); // Ocualquiera que necesites mostrar
              compra.appendChild(textcompra);
              d.appendChild(compra);
              compra.appendChild(span);

              if(element.EV_consolidacion == 0){
                
                const comentario = document.createElement('p');
                const textcomentario = document.createTextNode("Comentario: " + element.EV_comentario_no_consolidacion); // Ocualquiera que necesites mostrar
                comentario.appendChild(textcomentario);
                d.appendChild(comentario);

              }

              const cliente = document.createElement('p');
              const textcliente = document.createTextNode("Cliente: " + element.EV_cliente); // Ocualquiera que necesites mostrar
              cliente.appendChild(textcliente);
              d.appendChild(cliente);
              
              if (element.EV_direccion == '-') {
                element.EV_direccion = "No tiene  direccion registrada";
              }
              const direccion = document.createElement('p');
              const textdireccion = document.createTextNode("Direccion: " + element.EV_direccion); // Ocualquiera que necesites mostrar
              direccion.appendChild(textdireccion);
              d.appendChild(direccion);

              
              const grupo = document.createElement('p');
              const textgrupo = document.createTextNode("Grupo: " + element.EV_cliente_grupo); // Ocualquiera que necesites mostrar
              grupo.appendChild(textgrupo);
              d.appendChild(grupo);

              const espacio = document.createElement('br');
              const textespacio = document.createTextNode(""); // Ocualquiera que necesites mostrar
              espacio.appendChild(textespacio);
              d.appendChild(espacio);
              
            });
            $("#eventoModal").on("hidden.bs.modal", function () {
              while (list.lastChild) {
                list.removeChild(list.lastChild);
              }
            });

          }
        }
      });
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