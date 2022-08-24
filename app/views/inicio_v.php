<main>
  <div
    id="banner"
    class="d-flex justify-content-start flex-column align-items-center"
  >
    <h1 class="m-4 text-white text-center">EMPIEZA A BUSCAR TU CASA</h1>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="alquileres"
          name="alquiler_venta"
          value="A"
          checked
        />
        <label class="form-check-label" for="alquileres">ALQUILERES</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="ventas"
          name="alquiler_venta"
          value="V"
        />
        <label class="form-check-label" for="ventas">VENTAS</label>
      </div>
    <div id="buscador" class="input-group m-4">
    <input class="form-control" list="provincia" id="provincia" placeholder="Buscar Provincia...">
      <datalist id="provincia">
        <?php
          $cadena=""; 
          if(isset($provincias)){
          foreach($provincias as $prov){
            $cadena.="<option value='$prov[provincia]'>$prov[provincia]</option>";
          }
          echo $cadena;
          }
        ?>  
      </datalist>
      <button class="btn btn-primary buscar">Buscar</button>
    </div>
  </div>
  <?php if(!empty($nuevas)){ ?>
  <h1 class="text-center text-white">Publicadas Hoy</h1>
  <div class="container-xl">  
  <div id="carousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
  <?php foreach($nuevas as $ind=>$new){
    $activo = $ind==0 ? "active" : ""; ?>
    <div class="carousel-item <?php echo $activo?>">
      <img class="d-block w-100 imagen" src="../<?php echo $new['camino']?>" alt="Casa<?php echo $ind?>" data-id="<?php echo $new['codigoVivienda']?>">
    </div>
  <?php }?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>
</div>
<?php }?>
</main>
<script>
  const BASE_URL="<?php echo BASE_URL; ?>";
  /****
   * Cuando pulsamos el boton de buscar le pasamos el checked de alquiler o venta y la provincia si esixte
   */
  $(".buscar").on("click",function(){
    provincia=$("#provincia").val();
    tipo=$('input:radio[name=alquiler_venta]:checked').val();
    location = BASE_URL+"Publicaciones/index/"+tipo+"/"+provincia;
  });
  $('#provincia').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
      provincia=$("#provincia").val();
      tipo=$('input:radio[name=alquiler_venta]:checked').val();
      location = BASE_URL+"Publicaciones/index/"+tipo+"/"+provincia;
    }
});
/****
 * Cuando hacemos click en la imagen del carousel llevamos a la vista detallada 
 */
$("#carousel").on("click", ".imagen", function () {
  location.href = BASE_URL + "Publicaciones/detalles/" + $(this).data("id");
});
</script>
