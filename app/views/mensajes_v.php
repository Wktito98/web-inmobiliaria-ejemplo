<main>
    <div class="container-xxl" id="misMensajes">
      
    </div>
</main>
<script>
const BASE_URL="<?php echo BASE_URL; ?>";
/****
 * Cuando cargamos la pagina cargamos los nombres con los que tenemos conversaciones
 */
$(document).ready(function () {
  $.post(
    BASE_URL + "Mensajes/generarMensajes",
    function (datosdevueltos) {
      $("#misMensajes").html(datosdevueltos);
    }
  );
});
/****
 * Cuando pulsamos sobre la persona con la que queremos chatear pasamos por parametro el id de esa persona al chat
 */
$("#misMensajes").on("click",".persona",function(){
  let idEmisor=$(this).data("id");
  console.log(idEmisor);
  location.href = BASE_URL + "Chat/index/" + $(this).data("id");
})
</script>