/****
 * Cuando se carga la pagina cargamos las publicaciones
 */
$(document).ready(function () {
  $.post(
    BASE_URL + "Publicaciones/genPublicaciones",
    { prov: provincia, venta_alquiler: venta_alquiler, nuevos: nuevos },
    function (datosdevueltos) {
      $("#publicaciones").html(datosdevueltos);
    }
  );
});
/****
 * Cuando pulsamos en contactar nos saldra un input para iniciar una conversacion con la persona que ha publicado ese anuncio
 */
$("#publicaciones").on("click", ".contactar", function () {
  let id_receptor = $(this).data("id");
  Swal.fire({
    title: "Escribe tu Mensaje",
    input: "text",
    showCancelButton: true,
    confirmButtonText: "Enviar",
    cancelButtonText: "Cancelar",
  }).then((resultado) => {
    if (resultado.value) {
      let mensaje = resultado.value;
      $.post(
        BASE_URL + "Mensajes/enviarMensaje",
        { mensaje: mensaje, id_receptor: id_receptor },
        function () {}
      );
    }
  });
});
/****
 * Cuando pulsamos sobre la imagen de la publicacion generamos una vista detallada enviandole el id por parametro
 */
$("#publicaciones").on("click", ".imagen", function () {
  location.href = BASE_URL + "Publicaciones/detalles/" + $(this).data("id");
});
/****
 * Cuando el canvas se cierra se envian los datos a la generacion de publicaciones para aplicar los filtros añadidos
 */
$("#filtros").on("hidden.bs.offcanvas", function () {
  let tipo = $("#tipo").val();
  let precio_min = $("#precio_min").val();
  let precio_max = $("#precio_max").val();
  let tamaño_min = $("#tamaño_min").val();
  let tamaño_max = $("#tamaño_max").val();
  let habitaciones = $("input:radio[name=habitaciones]:checked").val();
  let baños = $("input:radio[name=baños]:checked").val();
  let aire = $("#aire").prop("checked");
  let armario = $("#armario").prop("checked");
  let ascensor = $("#ascensor").prop("checked");
  let garaje = $("#garaje").prop("checked");
  let jardin = $("#jardin").prop("checked");
  let piscina = $("#piscina").prop("checked");
  let terraza = $("#terraza").prop("checked");
  let trastero = $("#trastero").prop("checked");
  let bajos = $("#bajos").prop("checked");
  let intermedias = $("#intermedias").prop("checked");
  let ultima = $("#ultima").prop("checked");
  let filtro = true;
  $.post(
    BASE_URL + "Publicaciones/genPublicaciones",
    {
      prov: provincia,
      venta_alquiler: venta_alquiler,
      filtro: filtro,
      tipo: tipo,
      precio_min: precio_min,
      precio_max: precio_max,
      tamaño_min: tamaño_min,
      tamaño_max: tamaño_max,
      habitaciones: habitaciones,
      baños: baños,
      aire: aire,
      armario: armario,
      ascensor: ascensor,
      garaje: garaje,
      jardin: jardin,
      piscina: piscina,
      terraza: terraza,
      trastero: trastero,
      bajos: bajos,
      intermedias: intermedias,
      ultima: ultima,
      nuevos: nuevos,
    },
    function (datosdevueltos) {
      $("#publicaciones").html(datosdevueltos);
    }
  );
});
