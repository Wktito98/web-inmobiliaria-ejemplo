<main>
  <section class="vh-80">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 pb-2 pt-2 text-center">
            <div class="mb-md-5 mt-md-4">

              <h2 class="fw-bold mb-2 text-uppercase preferencias">Preferencias</h2>
              <p class="text-white-50 mb-5">Ajusta para recibir notificaciones personalizadas.</p>

              <div id="preferencias">
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
<script>

const BASE_URL="<?php echo BASE_URL; ?>";
//Cargamos las preferencias del usuario cunado carga la pagina
$(document).ready(function () {
  $.post(
    BASE_URL + "Notificaciones/genPreferencias",
    function (datosdevueltos) {
      $("#preferencias").html(datosdevueltos);
    }
  );
});
//Al hacer click en aplicar se aplican las nuevas preferencias
$("#preferencias").on("click", "#btnAplicar",function () {
  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Preferincias Aplicadas',
    showConfirmButton: false,
    timer: 1500
  })
});

</script>