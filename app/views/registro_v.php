<main>
<section class="vh-80">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Registro</h2>
              <p class="text-white-50 mb-5">Por favor ingrese su usuario y contraseña.</p>

              <form action="<?php echo BASE_URL?>Inicio/insertarUsuario" method="post">
                  <div class="form-outline form-white mb-4">
                      <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" placeholder="Nombre" maxlength="50" required autofocus/>
                  </div>

                  <div class="form-outline form-white mb-4">
                      <input type="text" id="apellidos" name="apellidos" class="form-control form-control-lg" placeholder="Apellidos" maxlength="100" required/>
                  </div>

                  <div class="form-outline form-white mb-4">
                      <input type="text" id="telefono" name="telefono" class="form-control form-control-lg" placeholder="Telefono" maxlength="11"required/>
                  </div>

                  <div class="form-outline form-white mb-4">
                      <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Email" maxlength="50" required/>
                  </div>

                  <div class="form-outline form-white mb-4">
                      <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" placeholder="Usuario" maxlength="60" required/>
                  </div>

                  <div class="form-outline form-white mb-4">
                      <input type="password" id="clave" name="clave" class="form-control form-control-lg" placeholder="Contraseña" maxlength="60" required/>
                      <div class="input-group-append">
                        <button type="button" tabindex="-1" class="btn btn-secondary m-2" id="verClave">Mostrar Contraseña</button>
                      </div>
                  </div>

                  <button  type="submit" id="registrarse" disabled class="btn btn-outline-light btn-lg px-5">Registrate</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
<script>
  const BASE_URL = "<?php echo BASE_URL; ?>";
  /****
   * Cuando pasamos de focus enviamos los datos a comprobar para ver si existe en la BBDD
   */
  let usuarioConfirm=false;
  let telefonoConfirm=false;
  let emailConfirm=false;
  $("#usuario").on("blur", function(evento){
    if (this.value.length>0){
      $.post(BASE_URL+"Inicio/comprobarDatosRegistro",{"usuemailtel":this.value},function(datos){
        if (datos=="1"){
          Swal.fire('El Usuario ya Existe');
          usuarioConfirm=false;
        }else{
          usuarioConfirm=true;
        }
        habilitarEnvio();
      })
    }
    
  })
  
  $("#email").on("blur", function(evento){
    if (this.value.length>0){
      $.post(BASE_URL+"Inicio/comprobarDatosRegistro",{"usuemailtel":this.value},function(datos){
        if (datos=="1"){
          Swal.fire("Email ya existe en la aplicación");
          emailConfirm=false;
        }else{
          emailConfirm=true;
        }
        habilitarEnvio();
      })
    }
   
  })
  
  $("#telefono").on("blur", function(evento){
    if (this.value.length>0){
      $.post(BASE_URL+"Inicio/comprobarDatosRegistro",{"usuemailtel":this.value},function(datos){
        if (datos=="1"){
          Swal.fire("Telefono ya existe en la aplicación");
          telefonoConfirm=false;
        }else{
          telefonoConfirm=true;
        }
        habilitarEnvio();
      })
    }
   
  });
  
  function habilitarEnvio(){
    if (telefonoConfirm==true && usuarioConfirm==true && emailConfirm==true) {
    $("#registrarse").removeAttr("disabled");
    }else{
    $("#registrarse").attr("disabled",true);
    }
  }

  $("form").submit(function(evento){
    Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Usuario Creado',
    showConfirmButton: false,
    timer: 1500
  })
  });
  /****
   * Mostrar Boton para mostrar contraseña
   */
  $("#verClave").on("click",function(evento){
   if ($("#clave").attr("type")=="text"){
      $("#clave").attr("type","password");
      $("#verClave").html("Mostrar Contraseña")
   } else {
     $("#clave").attr("type","text");
     $("#verClave").html("Ocultar Contraseña")
   }

  });
</script>