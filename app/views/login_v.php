<main>
<section class="vh-80">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Por favor ingrese su usuario y contraseña.</p>

              <form action="<?php echo BASE_URL?>Inicio/comprobarlogin" method="post" name="formu" class="needs-validation">
                  <div class="form-outline form-white mb-4">
                      <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" placeholder="Usuario"/>
                  </div>
                  <div class="form-outline form-white mb-4">
                      <input type="password" id="clave" name="clave" class="form-control form-control-lg" placeholder="Contraseña"/>
                  </div>
                  <?php
                      if(isset($mensaje)){
                    ?>
                      <div class="row d-flex justify-content-center mt-2">
                        <div class="col-12">
                          <div class="alert alert-danger" role="alert">
                            <strong><?php echo $mensaje ?></strong>
                          </div>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </form>
            </div>
            <div>
              <p class="mb-0">¿No tienes cuenta? <a href="<?php echo BASE_URL; ?>Inicio/registro" class="text-white-50 fw-bold">Registrate</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</section>
</main>
<script>
  //Validar el formulario
  $('document.formu').on('submit', function (evento) {
    if (!$(this).checkValidity()) {
      evento.preventDefault();
    } 
    form.addClass('was-validated')
  }); 
</script>