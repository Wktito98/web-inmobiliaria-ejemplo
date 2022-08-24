/****
 * Generar Publicaciones Cuando se Carga la pagina
 */
$(document).ready(function () {
  $.post(
    BASE_URL + "MisPublicaciones/genMisPublicaciones",
    function (datosdevueltos) {
      $("#misPublicaciones").html(datosdevueltos);
    }
  );
});
/****
 * Cuando cambia el boton de estado se cambia en la BBDD
 */
$("#misPublicaciones").on("change", "input[type=checkbox]", function () {
  let cod = $(this).data("id");
  let activo = $(this).prop("checked");

  $.post(
    BASE_URL + "MisPublicaciones/cambiarEstado",
    { activo: activo, cod: cod },
    function () {}
  );
});
/****
 * Cuando se Pulsa el boton de eliminar se muestra una alerta de confirmacion
 * y se mandan los datos para la eliminacion
 */
$("#misPublicaciones").on("click", ".eliminar", function () {
  let cod = $(this).data("id");
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
          BASE_URL + "MisPublicaciones/elimimnarPublicacion",
          { cod: cod },
          function (datosdevueltos) {
            $("#misPublicaciones").html(datosdevueltos);
          }
        );
      }
    });
});
/****
 * Cuando se pulsa el boton de editar enviamos a la pagina de editar con el codigo de la vivienda que hemos seleccionado
 */
$("#misPublicaciones").on("click", ".editar", function () {
  let cod = $(this).data("id");
  location.href = BASE_URL + "MisPublicaciones/editar/" + cod;
});
