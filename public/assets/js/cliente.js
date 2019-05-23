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
        {"defaultContent":"<button class='ver btn btn-info'><i class='fa fa-eye'></i></button><button class='eventos btn btn-warning'><i class='fa fa-expand'></i></button>"},
      ],
      "language": idioma_espanol,
      
    
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "pageLength": 5000,
      "lengthMenu": [[5,10,20, -1],[5,10,50,"Mostrar Todo"]],
      dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
      
      
    
      buttons: {
        dom: {
          container:{
            tag:'div',
            className:'flexcontent'
          },
          buttonLiner: {
            tag: null
          }
        },
      buttons: [
        {
            extend:    'copyHtml5',
            text:      '<i class="fa fa-clipboard"></i>Copiar',
            title:'Titulo de tabla copiada',
            titleAttr: 'Copiar',
            className: 'btn btn-app export barras',
            exportOptions: {
                columns: [ 0, 1,2,3,4]
            }
        },

        {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf-o"></i>PDF',
            title:'Clientes',
            titleAttr: 'PDF',
            className: 'btn btn-app export pdf',
            exportOptions: {
                columns: [ 0,1,2,3,4]
            },
            customize:function(doc) {

                doc.styles.title = {
                    color: '#4c8aa0',
                    fontSize: '30',
                    alignment: 'center'
                }
                doc.styles['td:nth-child(2)'] = { 
                    width: '100px',
                    'max-width': '100px'
                },
                doc.styles.tableHeader = {
                    fillColor:'#4c8aa0',
                    color:'white',
                    alignment:'center'
                },
                doc.content[1].margin = [ 100, 0, 100, 0 ]
            }
        },
        {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel-o"></i>Excel',
            title:'Clientes',
            titleAttr: 'Excel',
            className: 'btn btn-app export excel',
            exportOptions: {
                columns: [ 0,1,2,3,4]
            },
        },
            ]
    }
    });
     ver("#dt_cliente tbody",table);
  }

  var ver = function(tbody,table){
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
    
    $(tbody).on("click","button.eventos", function(){
      $('#eventoModal').modal('show');
      var data = table.row( $(this).parents("tr")).data();
      var id = data.CL_ID;
      $.ajax({
        url: 'evento/cliente/'+ id,
        type:'GET',
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

              const asesor = document.createElement('p');
              const textasesor = document.createTextNode("Asesor: " + element.EV_asesor); // Ocualquiera que necesites mostrar
              asesor.appendChild(textasesor);
              d.appendChild(asesor);
              
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
  
  