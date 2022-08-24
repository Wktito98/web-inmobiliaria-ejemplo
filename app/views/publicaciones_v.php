<link rel="stylesheet" href="<?php echo BASE_URL;?>/app/assets/libs/css/scroll_v.css">
<main>
  <div
    class="offcanvas offcanvas-start bg-dark text-white"
    tabindex="-1"
    id="filtros"
    aria-labelledby="offcanvasExampleLabel"
  >
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">
        <i class="bi bi-funnel"></i> Filtros
      </h5>
      <button
      class="btn btn-primary m-2"
      type="button"
      id="limpiar">
      <i class="bi bi-trash3 reset"></i> Limpiar
    </button>
      <button
        type="button"
        class="btn-close text-reset cerrar"
        data-bs-dismiss="offcanvas"
        aria-label="Close"
      ></button>
    </div>
    <div class="offcanvas-body">
    <div class="container-xxl">
      <label for="tipo block" class="subtitulo">TIPO DE INMUEBLE</label>
      <select id="tipo" class="form-select" aria-label="Default select example">
        <option selected value="" >Seleciona el tipo de Inmueble</option>
        <option value="0">TODOS</option>
        <option value="1">Obra Nueva</option>
        <option value="2">Vivienda</option>
        <option value="3">Oficina</option>
        <option value="4">Local o Nave</option>
        <option value="5">Garaje</option>
        <option value="6">Terreno</option>
        <option value="7">Trastero</option>
        <option value="8">Edificio</option>
        <option value="9">Estudio</option>
      </select>
      </div>
    <div class="container-xxl">
      <label for="tipo" class="subtitulo">PRECIO</label>
      <div class="d-flex justify-content-evenly">
        <input
          id="precio_min"
          type="number"
          class="form-control m-1"
          placeholder="MIN"
          aria-label="minimo"
          aria-describedby="basic-addon1"
        />

        <input
          id="precio_max"
          type="number"
          class="form-control m-1"
          placeholder="MAX"
          aria-label="minimo"
          aria-describedby="basic-addon1"
        />
      </div>
    </div>
    <div class="container-xxl">
      <label for="tipo" class="subtitulo">TAMAÑO</label>
      <div class="d-flex justify-content-evenly">
        <input
          id="tamaño_min"
          type="number"
          class="form-control m-1"
          placeholder="MIN"
          aria-label="minimo"
          aria-describedby="basic-addon1"
        />

        <input
          id="tamaño_max"
          type="number"
          class="form-control m-1"
          placeholder="MAX"
          aria-label="minimo"
          aria-describedby="basic-addon1"
        />
      </div>
    </div>
    <div class="container-xxl">
      <label class="form-check-label subtitulo"> HABITACIONES </label>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="cero"
          name="habitaciones"
          value="0"
        />
        <label class="form-check-label" for="cero">0 Habitaciones</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="uno"
          name="habitaciones"
          value="1"
        />
        <label class="form-check-label" for="uno">1</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="dos"
          name="habitaciones"
          value="2"
        />
        <label class="form-check-label" for="dos">2</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="tres"
          name="habitaciones"
          value="3"
        />
        <label class="form-check-label" for="tres">3</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="cuatro"
          name="habitaciones"
          value="4"
        />
        <label class="form-check-label" for="cuatro">4</label>
      </div>
    </div>
    <div class="container-xxl">
      <label class="form-check-label subtitulo"> BAÑOS </label>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="uno"
          name="baños"
          value="1"
        />
        <label class="form-check-label" for="uno">1</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="dos"
          name="baños"
          value="2"
        />
        <label class="form-check-label" for="dos">2</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="tres"
          name="baños"
          value="3"
        />
        <label class="form-check-label" for="tres">3</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          id="cuatro"
          name="baños"
          value="4"
        />
        <label class="form-check-label" for="cuatro">4</label>
      </div>
    </div>
    <div class="container-xxl">
      <label class="subtitulo">CARACTERISTICAS</label>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="aire" />
        <label class="form-check-label" for="aire">Aire Acondicionado</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="armario" />
        <label class="form-check-label" for="armario">Armario Empotrado</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="ascensor" />
        <label class="form-check-label" for="ascensor">Ascensor</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="garaje" />
        <label class="form-check-label" for="garaje">Garaje</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="jardin" />
        <label class="form-check-label" for="jardin">Jardin</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="piscina" />
        <label class="form-check-label" for="piscina">Piscina</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="terraza" />
        <label class="form-check-label" for="terraza">Terraza</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="trastero" />
        <label class="form-check-label" for="trastero">Trastero</label>
      </div>
    </div>
    <div class="container-xxl">
      <label class="subtitulo">PLANTA</label>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="bajos" />
        <label class="form-check-label" for="bajos">Bajos</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="intermedias" />
        <label class="form-check-label" for="intermedias"
          >Plantas Intermedias</label
        >
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="ultima" />
        <label class="form-check-label" for="ultima">Ultima Planta</label>
      </div>
    </div>
  </div>
  </div>
  <div id="botones" class="container-xxl">
    <button
      class="btn btn-primary m-2"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#filtros"
      aria-controls="filtros"
    >
      <i class="bi bi-filter"></i> Filtros
    </button>
    
    <div id="publicaciones">
                    
    </div>
  </div>
</main>
<script>
  const BASE_URL = "<?php echo BASE_URL; ?>";
  let provincia = "<?php echo $provincia; ?>";
  let venta_alquiler = "<?php echo $venta_alquiler; ?>";
  let nuevos = "<?php echo $nuevos?>"
  //Limpiamos el filtro al pulsar limpiar
  $("#limpiar").click(function () {
    $("#tipo").val('');
    $("#precio_min").val('');
    $("#precio_max").val('');
    $("#tamaño_min").val('');
    $("#tamaño_max").val('');
    $("input:radio[name=habitaciones]").prop('checked', false);
    $("input:radio[name=baños]").prop('checked', false);
    $("#aire").prop("checked", false);
    $("#armario").prop("checked", false);
    $("#ascensor").prop("checked", false);
    $("#garaje").prop("checked", false);
    $("#jardin").prop("checked", false);
    $("#piscina").prop("checked", false);
    $("#terraza").prop("checked", false);
    $("#trastero").prop("checked", false);
    $("#bajos").prop("checked", false);
    $("#intermedias").prop("checked", false);
    $("#ultima").prop("checked", false);
  });
</script>
<script src="<?php echo BASE_URL; ?>app/views/publicaciones_v.js"></script>
