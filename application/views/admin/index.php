<div class="row">
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
            Numero clientes</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $qCts->cantidad ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
            Numero Prestamos</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $qLoans->cantidad ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Numero cobranzas
            </div>
            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $qPaids->cantidad ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Bienvenido <?php echo $this->session->userdata('first_name'). ' '.$this->session->userdata('last_name'); ?>!</h6>
    </div>
    <div class="card-body">
      <p class="text-center h5 mb-4">Total de prestamos por tipo de moneda</p>
      
      <canvas id="grafica"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>
<script>
  //When receiving data from a web server, the data is always a string.
  //Parse the data with JSON.parse(), and the data becomes a JavaScript object.
  var cData = JSON.parse('<?php echo $countLC; ?>');
 
  console.log("datos", cData)

  // Obtener una referencia al elemento canvas del DOM
  const $grafica = document.querySelector("#grafica");
  // Las etiquetas son las porciones de la gráfica
  const etiquetas = cData.label
  // Podemos tener varios conjuntos de datos. Comencemos con uno
  const datosIngresos = {
    data: cData.data, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    // Ahora debería haber tantos background colors como datos, es decir, para este ejemplo, 4
    backgroundColor: [
        'rgba(163,221,203,0.2)',
        'rgba(232,233,161,0.2)',
        'rgba(230,181,102,0.2)',
        'rgba(229,112,126,0.2)',
    ],// Color de fondo
    borderColor: [
        'rgba(163,221,203,1)',
        'rgba(232,233,161,1)',
        'rgba(230,181,102,1)',
        'rgba(229,112,126,1)',
    ],// Color del borde
    borderWidth: 1,// Ancho del borde
  };

  new Chart($grafica, {
    type: 'pie',// Tipo de gráfica. Puede ser dougnhut o pie
    data: {
      labels: etiquetas,
      datasets: [
          datosIngresos,
          // Aquí más datos...
      ]
    },
  });
</script>