<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/libs/fonts/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/libs/bootstrap/css/bootstrap.min.css" />
    <script src="<?php echo BASE_URL; ?>app/assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app/assets/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app/assets/libs/swalert/sweetalert2.all.min.js"></script>
    <title>HelloHome</title>
    <link rel="icon" href="<?php echo BASE_URL;?>/app/assets/img/iconInmobiliaria.png">
    <style>
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body{
        background-color: #171924;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
      }
      body::-webkit-scrollbar {
        width: 15px;
      }
      body::-webkit-scrollbar-thumb {
        background-color: #095cee;
        border-radius: 50px;
      }
      body::-webkit-scrollbar-thumb:hover {
        background-color: #1842c1;
      }
      #logo{
        width: 150px;
      }
      #cabecera{
        min-height: 10vh;
      }
      main{
        min-height: 80vh;
      }
      footer{
        height: 10vh;
      }
      #derechos{
        height: 100%;
      }
      #banner {
        height: 800px;
        background-image: url("<?php echo BASE_URL; ?>app/assets/img/banner.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
      }
      #buscador {
        width: 60%;
      }
      label {
        color: white;
        font-size: 1.1em;
      }
      .cerrar{
        color: white;
      }
    </style>
  </head>
  <body>
      <nav id="cabecera" class="navbar navbar-dark bg-dark">
        <div class="container-xxl">
        <a href="<?php echo BASE_URL; ?>Inicio/index"><img
          src="<?php echo BASE_URL; ?>app/assets/img/logo.png"
          class="navbar-brand mx-4"
          alt="HelloHome"
          id="logo"
        /></a>
          <a href="<?php echo BASE_URL; ?>Inicio/login" class="btn btn-primary mx-4" role="button">Iniciar Sesión</a>
        </div>
      </nav>