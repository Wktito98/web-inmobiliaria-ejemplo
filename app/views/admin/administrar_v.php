<link rel="stylesheet" href="<?php echo BASE_URL;?>/app/assets/libs/css/scroll_v.css">
<main>
    <div class="container">
        <h1 class="text-white">MODO ADMINISTRADOR</h1>
    <div id="publicaciones">
                    
    </div>
    </div>
</main>
<script>
  const BASE_URL="<?php echo BASE_URL; ?>";
  $(document).ready(function () {
  $.post(
    BASE_URL + "Admin/genPublicaciones",
    function (datosdevueltos) {
      $("#publicaciones").html(datosdevueltos);
    }
  );
});
/****
 * Enviamos el codigo de la vivienda sobre la que hemos pulsado eliminar
 */
$("#publicaciones").on("click", ".eliminar", function () {
  let cod = $(this).data("cod");
  swal
    .fire({
      title: "¿Está seguro de borrar la Publicacion?",
      text: "¡Si no lo está puede cancelar la acción!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar!",
    })
    .then(function (result) {
      if (result.value) {
        $.post(
          BASE_URL + "Admin/eliminarPublicacion",
          { cod: cod },
          function (datosdevueltos) {
            $("#misPublicaciones").html(datosdevueltos);
          }
        );
      }
      location.reload();
    });
});
</script>