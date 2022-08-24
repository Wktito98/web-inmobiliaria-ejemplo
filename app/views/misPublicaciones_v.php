<link rel="stylesheet" href="<?php echo BASE_URL;?>/app/assets/libs/css/scroll_v.css">
<main>
    <div class="container-xxl">
        <div class="row justify-content-md-center">
            <a href="<?php echo BASE_URL; ?>MisPublicaciones/publicar" 
            class="btn btn-primary col-6 m-3" role="button"><i class="bi bi-pin-angle"></i> Publica Tu Vivienda</a>
        </div>
        <div class="row" id="misPublicaciones">
        
        </div>
    </div>
</main>
<script>
    const BASE_URL="<?php echo BASE_URL; ?>";
</script>
<script src="<?php echo BASE_URL; ?>app/views/misPublicaciones_v.js"></script>