$(document).on("ready",function(){
  listar();
});

var listar = function(){
  var table = $("#dt_asesor").DataTable({
    data: data,
    "columns":[
      {"data":"AS_ID"},
      {"data":"AS_nombre"},
      {"data":"AS_visita"},
      {"data":"AS_ventas_total"},
      {"data":"AS_porcentaje_ventas"},
      {"defaultContent":"<button class='ver_asesor btn btn-warning'><i class='fa fa-expand'></i></button>"},
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
          title:'Asesores',
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
          title:'Asesores',
          titleAttr: 'Excel',
          className: 'btn btn-app export excel',
          exportOptions: {
              columns: [ 0,1,2,3,4]
          },
      },
          ]
  }
  });
   ver_asesor("#dt_asesor tbody",table);
}

var ver_asesor = function(tbody,table){
  $(tbody).on("click","button.ver_asesor", function(){
    $('#viewModalAsesor').modal('show');
    const elements = data2;
    var data_table = table.row( $(this).parents("tr")).data();
    var id = data_table.AS_ID;
    const list = document.querySelector('div[name="eventos"]');
    var i = 0;
        if (elements == '') {
            const _ = document.createElement('h2');
            const textElement = document.createTextNode("No tiene ningun evento registrado"); // Ocualquiera que necesites mostrar
            _.appendChild(textElement);
            
            list.appendChild(_);
            $("#viewModalAsesor").on("hidden.bs.modal", function () {
                while (list.lastChild) {
                    list.removeChild(list.lastChild);
                }
            });
        }else{
            $.ajax({
                type: 'GET',
                url: 'asesor/'+ id,
                datatype: 'json',
                success: function(result) {
                    var confirmacion = false;
                    elements.forEach((element) =>{
                      if(element.EV_asesor == result.AS_nombre){
                        console.log(result);
                      confirmacion = true;
                      console.log("entre");
                    }
                  })
                    if(confirmacion == true){
                      elements.forEach((element) => {
                        if(element.EV_asesor == result.AS_nombre){
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
                            const textasesor = document.createTextNode("Cliente: " + element.EV_cliente); // Ocualquiera que necesites mostrar
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
            
                          }
                        });
                    }else{
                      const _ = document.createElement('h2');
                      const textElement = document.createTextNode("No tiene ningun evento registrado"); // Ocualquiera que necesites mostrar
                      _.appendChild(textElement);
                      
                      list.appendChild(_);
                      $("#viewModalAsesor").on("hidden.bs.modal", function () {
                          while (list.lastChild) {
                              list.removeChild(list.lastChild);
                          }
                      });
                    }
                }
            })
            $("#viewModalAsesor").on("hidden.bs.modal", function () {
              while (list.lastChild) {
                list.removeChild(list.lastChild);
              }
            });
          var i = 0;
        }
  })
  }



$(document).on("ready",function(){
  listar1();
});

var listar1 = function(){
  var table = $("#dt_cliente").DataTable({
    data: data1,
    "columns":[
      {"data":"CL_ID"},
      {"data":"CL_nombre_completo"},
      {"data":"CL_referencia"},
      {"data":"CL_numero_visitas"},
      {"data":"CL_numero_compras"},
      {"data":"CL_porcentaje_ventas"},
      {"defaultContent":"<button class='ver_cliente btn btn-warning'><i class='fa fa-expand'></i></button>"},
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
              columns: [ 0,1,2,3,4,5]
          }
      },

      {
          extend:    'pdfHtml5',
          text:      '<i class="fa fa-file-pdf-o"></i>PDF',
          title:'Clientes',
          titleAttr: 'PDF',
          className: 'btn btn-app export pdf',
          exportOptions: {
              columns: [ 0,1,2,3,4,5]
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
              columns: [ 0,1,2,3,4,5]
          },
      },
          ]
  }
  });
   ver("#dt_cliente tbody",table);
}

var ver = function(tbody,table){
  $(tbody).on("click","button.ver_cliente", function(){
    $('#viewModalAsesor').modal('show');
    const elements = data2;
    var data_table = table.row( $(this).parents("tr")).data();
    var id = data_table.CL_ID;
    const list = document.querySelector('div[name="eventos"]');
    var i = 0;
        if (elements == '') {
            const _ = document.createElement('h2');
            const textElement = document.createTextNode("No tiene ningun evento registrado"); // Ocualquiera que necesites mostrar
            _.appendChild(textElement);
            
            list.appendChild(_);
            $("#viewModalAsesor").on("hidden.bs.modal", function () {
                while (list.lastChild) {
                    list.removeChild(list.lastChild);
                }
            });
        }else{
          
          $.ajax({
            type: 'GET',
            url: 'cliente/'+ id,
            datatype: 'json',
            success: function(result) {
                var confirmacion = false;
                console.log(elements)
                elements.forEach((element) =>{
                  if(element.EV_cliente == result.CL_nombre_completo){
                    console.log(result);
                    confirmacion = true;
                    console.log("entre");
                  }
              })
                if(confirmacion == true){
                  elements.forEach((element) => {
                    if(element.EV_cliente == result.CL_nombre_completo){
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
                        const textasesor = document.createTextNode("Cliente: " + element.EV_cliente); // Ocualquiera que necesites mostrar
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
        
                      }
                    });
                }else{
                  const _ = document.createElement('h2');
                  const textElement = document.createTextNode("No tiene ningun evento registrado"); // Ocualquiera que necesites mostrar
                  _.appendChild(textElement);
                  
                  list.appendChild(_);
                  $("#viewModalAsesor").on("hidden.bs.modal", function () {
                      while (list.lastChild) {
                          list.removeChild(list.lastChild);
                      }
                  });
                }
            }
        })
        $("#viewModalAsesor").on("hidden.bs.modal", function () {
          while (list.lastChild) {
            list.removeChild(list.lastChild);
          }
        });
      var i = 0;
    }
})
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

  