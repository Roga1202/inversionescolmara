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

    function fun_delete($id)
    {
        var view_url = '/evento/'+$id;
        $.ajax({
          url: view_url,
          type:'GET',
          datatype: 'json',
          async: true,
          success: function(result){
          console.log(result);
          $("#ID").val(result.EV_ID);
          $("#asesor").val(result.EV_asesor);
          $("#cliente").val(result.EV_cliente);
          $("#fecha").val(result.EV_fecha);
          }
        });
      } 

  // delete a post
$('.modal-footer').on('click', '.delete', function() {
    var id = $("#ID").val();
    $.ajax({
        type: 'delete',
        url: 'evento/eliminar/' + id,
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function(data) {
          location.reload();
        }
    });
});

function validar(){
  var input = document.getElementById("evento");
  if(input.value != ""){
      document.getElementById("enviar").disabled = "";  
  }else{
    document.getElementById("enviar").disabled = "disabled"; 
  }
}


