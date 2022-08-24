<main>
  <div class="container py-5 h-100" id="dashboard">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="card border-primary m-4 bg-dark" style="max-width: 18rem;">
        <div class="card-header text-white">Visitas</div>
          <div class="card-body text-primary">
          <h1 class="card-title"><i class="bi bi-graph-up-arrow"></i></h1>
          <h2 class="card-text text-white counter"><?php echo $visitas['valor']?></h2>
        </div>
      </div>
      
      <div class="card border-warning m-4 bg-dark" style="max-width: 18rem;">
        <div class="card-header text-white">Usuarios</div>
          <div class="card-body text-warning">
          <h1 class="card-title"><i class="bi bi-person-fill"></i></h1>
          <h2 class="card-text text-white counter"><?php echo $usuarios['valor']?></h2>
        </div>
      </div>

      <div class="card border-success m-4 bg-dark" style="max-width: 18rem;">
        <div class="card-header text-white">Publicaciones</div>
          <div class="card-body text-success">
          <h1 class="card-title"><i class="bi bi-file-earmark-post"></i></h1>
          <h2 class="card-text text-white counter"><?php echo $publicaciones['valor']?></h2>
        </div>
      </div>
      
    </div>
  </div>

  <div class="container" id="graficos">
    <h1 class="text-white text-center mb-5">ALQUILERES / VENTAS</h1>
    <canvas id="myChart"></canvas>
  </div>
</main>
<script>
  let alquileres="<?php echo $alquiler?>";
  let ventas="<?php echo $ventas?>";
  $(document).ready(function () {
      $(".counter").counterUp({
        delay: 10,
        time: 1200,
      });
    });

  const ctx = document.getElementById("myChart");
  const myChart = new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: ["Alquiler", "Venta"],
      datasets: [
        {
        label: "My First Dataset",
        data: [alquileres, ventas],
        backgroundColor: ["rgb(63, 63, 191)", "rgb(63, 191, 191)"],
        hoverOffset: 4,
      },
    ],
  },
});

</script>
