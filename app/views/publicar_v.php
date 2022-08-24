<main>
<section class="vh-80">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
        <form  action="<?php echo BASE_URL; ?>MisPublicaciones/insertarPublicacion" method="post" enctype="multipart/form-data">
          <h3 class="text-center">Direccion</h3>
          <hr>
          <div class="row m-3">
            <div class="col-xxl-6 col-md-12 mb-3">
              <label class="mb-2" for="direccion">Direccion de la Vivienda</label>
              <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" maxlength="200" required autofocus>
            </div>
            <div class="col-xxl-2 col-md-6  mb-3">
              <label class="mb-2" for="numero">Número</label>
              <input type="text" class="form-control" id="numero" name="numero" placeholder="Nº" maxlength="11" required>
            </div>
            <div class="col-xxl-4 col-md-6  mb-3">
              <label class="mb-2" for="cp">Código Postal</label>
              <input type="text" class="form-control" id="cp" name="cp" placeholder="CP" maxlength="11" required>
            </div>
          </div>
        <div class="row m-3">
            <div class="col-xxl-4 col-md-12 mb-3">
                <label class="mb-2" for="pais">País</label>
                <input type="text" class="form-control" id="pais" name="pais" placeholder="Pais" maxlength="50" required>
            </div>
            <div class="col-xxl-4 col-md-12 mb-3">
                <label class="mb-2" for="provincia">Provincia</label>
                <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia" maxlength="50" required>
            </div>
            <div class="col-xxl-4 col-md-12 mb-3">
                <label class="mb-2" for="localidad">Localidad</label>
                <input type="text" class="form-control" id="localidad" name="localidad" placeholder="Localidad" maxlength="50" required>
            </div>
        </div>
        <h3 class="text-center">Tipo Transacción</h3>
          <hr>
          <div class="row m-3">
            <div class="col-xxl-6 col-md-6  mb-3">
              <label class="mb-2" for="precio">Precio de la Vivienda</label>
              <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio €" maxlength="11" required>
            </div>
            <div class="col-xxl-6 col-md-6 mb-3">
                <label class="mb-2" for="venta_alquiler">¿Venta o Alquiler?</label>
                <select class="form-control" id="venta_alquiler" name="venta_alquiler" required>
                  <option disabled>-- Venta o Alquiler --</option>
                  <option value="V">Venta</option>
                  <option value="A">Alquilar</option>
                </select>
            </div>
          </div>
          <h3 class="text-center">Caracteristicas</h3>
          <hr>
        <div class="row m-3">
            <div class="col-xxl-2 col-md-4 mb-3">
                <label class="mb-2" for="metros">Metros Cuadrados</label>
                <input type="text" class="form-control" id="metros" name="metros" placeholder="Metros m²" maxlength="11" required>
            </div>
            <div class="col-xxl-3 col-md-4 mb-3">
                <label class="mb-2" for="planta">Planta</label>
                <select class="form-control" id="planta" name="planta" required>
                <option disabled>-- Selecciona Planta --</option>
                <?php
                  $cadena=""; 
                  foreach($planta as $grupo){
                    $cadena.="<option value='$grupo[id]'>$grupo[descripcion]</option>";
                  }
                  echo $cadena;
                ?>  
                </select>
            </div>
            <div class="col-xxl-3 col-md-4 mb-3">
                <label class="mb-2" for="tipo">Tipo de Venta</label>
                <select class="form-control" id="tipo" name="tipo" required>
                <option disabled>-- Tipo de Vivienda --</option>
                <?php
                  $cadena=""; 
                  foreach($tipo as $grupo){
                    $cadena.="<option value='$grupo[id]'>$grupo[descripcion]</option>";
                  }
                  echo $cadena;
                ?>  
                </select>
            </div>
            <div class="col-xxl-2 col-md-6 mb-3">
                <label class="mb-2" for="habitaciones">Nº de Habitaciones</label>
                <select class="form-control" id="habitaciones" name="habitaciones" required>
                <option disabled>-- Nº Habitaciones --</option>
                  <option value="0">0 Habitaciones</option>
                  <option value="1">1 Habitacion</option>
                  <option value="2">2 Habitaciones</option>
                  <option value="3">3 Habitaciones</option>
                  <option value="4">4 o Mas Habitaciones</option>
                </select>
            </div>
            <div class="col-xxl-2 col-md-6 mb-3">
                <label class="mb-2" for="banios">Nº de Baños</label>
                <select class="form-control" id="banios" name="banios" required>
                  <option disabled>-- Nº Baños --</option>
                  <option value="0">0 Baños</option>
                  <option value="1">1 Baño</option>
                  <option value="2">2 Baños</option>
                  <option value="3">3 Baños</option>
                  <option value="4">4 o Mas Baños</option>
                </select>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12">
                <label class="mb-2" for="descripcion">Ovservaciones para el anuncio:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" required></textarea>
            </div>
        </div>
        <div class="row m-3">
        </div>
        <div class="row m-3">
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="piscina"
                    name="piscina"
                  />
                  <label class="form-check-label" for="piscina">Piscina</label>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="aire_acondicionado"
                  />
                  <label class="form-check-label" for="aire_acondicionado">Aire Acondicionado</label>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="armarios_empotrados"
                    name="armarios_empotrados"
                  />
                  <label class="form-check-label" for="piscina">Armarios Empotrados</label>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="ascensor"
                    name="ascensor"
                  />
                  <label class="form-check-label" for="ascensor">Ascensor</label>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="terraza"
                    name="terraza"
                  />
                  <label class="form-check-label" for="terraza">Terraza</label>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="trastero"
                    name="trastero"
                  />
                  <label class="form-check-label" for="trastero">Trastero</label>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="garaje"
                    name="garaje"
                  />
                  <label class="form-check-label" for="garaje">Garaje</label>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 mb-3">
                <div class="form-check form-switch">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="jardin"
                    name="jardin"
                  />
                  <label class="form-check-label" for="jardin">Jardín</label>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12 mb-3">
                <label for="imagenes" class="form-label">Imagenes</label>
                <input class="form-control" type="file" multiple name="imagenes[]" required accept=".jpg,.jpeg">
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
<script>

</script>