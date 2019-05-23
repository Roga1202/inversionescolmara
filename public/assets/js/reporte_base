function fun_view_asesor($id)
    {   
        const elements = data['pedido'];
        console.log(elements)
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
                url: 'asesor/'+ $id,
                datatype: 'json',
                success: function(result) {
                    var confirmacion = false;
                  elements.forEach((element) =>{
                    if(element.EV_asesor == result.AS_nombre){
                      confirmacion = true;
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
    }

    function fun_view_cliente($id)
    {   
      const elements = data['pedido'];
      const list = document.querySelector('div[name="eventos_cliente"]');
      var i = 0;
      if (elements == '') {
          const _ = document.createElement('h2');
          const textElement = document.createTextNode("No tiene ningun evento registrado"); // Ocualquiera que necesites mostrar
          _.appendChild(textElement);
          
          list.appendChild(_);
          $("#viewModalCliente").on("hidden.bs.modal", function () {
              while (list.lastChild) {
                  list.removeChild(list.lastChild);
              }
          });
      }else{
          $.ajax({
              type: 'GET',
              url: 'cliente/'+ $id,
              datatype: 'json',
              success: function(result) {
                var confirmacion = false;
                elements.forEach((element) =>{
                if(element.EV_cliente == result.CL_nombre_completo){
                  confirmacion = true;
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
        
                      }
                    });
                }else{
                  const _ = document.createElement('h2');
                  const textElement = document.createTextNode("No tiene ningun evento registrado"); // Ocualquiera que necesites mostrar
                  _.appendChild(textElement);
                  
                  list.appendChild(_);
                  $("#viewModalCliente").on("hidden.bs.modal", function () {
                      while (list.lastChild) {
                          list.removeChild(list.lastChild);
                      }
                  });
                }
            }
        })
        $("#viewModalCliente").on("hidden.bs.modal", function () {
          while (list.lastChild) {
            list.removeChild(list.lastChild);
          }
        });
      var i = 0;
    }
}