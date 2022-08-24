<link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/libs/css/chat_v.css" />
<main>
<h1 class="text-center text-white">Chat con <span class="text-primary"><?php echo strtoupper($nombreUsuario)?></span></h1>
<div id="mensajeria">
  <div id="chat">
  </div>
</div>
<div id="enviar">
    <input id="mensajeEnviar" type="text" placeholder="Escribe tu mensaje..." />
    <button id="btnEnviar" class="btn btn-primary"><i class="bi bi-send text-white"></i> Enviar</button>
  </div>
</main>
<script>
  const BASE_URL="<?php echo BASE_URL; ?>";
  receptor=<?php echo $receptor?>;
  /****
   * Cuando carga generamos los mensajes
   */
  $(document).ready(function () {
  $.post(
    BASE_URL + "Chat/genChat",{receptor:receptor},
    function (datosdevueltos) {
      $("#chat").html(datosdevueltos);
    }
  );
  //Pasamos todos los mensajes a leido
  $.post(
    BASE_URL + "Mensajes/leido",{receptor:receptor},
    function () {}
  );
  });
  /****
   * Cuando se pulsa el boton de enviar enviamos el mensaje
   */
  $("#btnEnviar").on("click",function(){
    mensaje=$("#mensajeEnviar").val();
    $.post(
        BASE_URL + "Mensajes/enviarMensaje",
        { mensaje: mensaje, id_receptor: receptor },
        function () {}
      );
      //Volvemos a actualizar los mensajes
    $("#mensajeEnviar").val('');
    $.post(
    BASE_URL + "Chat/genChat",{receptor:receptor},
    function (datosdevueltos) {
      $("#chat").html(datosdevueltos);
    }
    );
    //Bajamos el scroll para ver los mensajes recientes
    $("#chat").animate({ scrollTop: $('#chat')[0].scrollHeight}, 1000);
    location.reload();
  })

  $("#mensajeEnviar").keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
      mensaje=$("#mensajeEnviar").val();
    $.post(
        BASE_URL + "Mensajes/enviarMensaje",
        { mensaje: mensaje, id_receptor: receptor },
        function () {}
      );
      //Volvemos a actualizar los mensajes
    $("#mensajeEnviar").val('');
    $.post(
    BASE_URL + "Chat/genChat",{receptor:receptor},
    function (datosdevueltos) {
      $("#chat").html(datosdevueltos);
    }
    );
    //Bajamos el scroll para ver los mensajes recientes
    $("#chat").animate({ scrollTop: $('#chat')[0].scrollHeight}, 1000);
    location.reload();
    }    
  })
</script>

