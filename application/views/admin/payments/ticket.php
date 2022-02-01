<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ticket No 132</title>

  <link href="<?php echo site_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <style type="text/css" media="all">
    body { color: #000; }
    #wrapper { max-width: 520px; margin: 0 auto; padding-top: 20px; }
    .btn { margin-bottom: 5px; }
    .table { border-radius: 3px; }
    .table th { background: #f5f5f5; }
    .table th, .table td { vertical-align: middle !important; }
    tfoot tr th:first-child { text-align: right; }

    @media print {
      .no-print { display: none; }
      #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
    }
  </style>
</head>
<body>
  <div id="wrapper">
    <div id="receiptData" style="width: auto; max-width: 580px; min-width: 250px; margin: 0 auto;">

      <?php
        if($pagoAbono == true){
      ?>
        <div id="receipt-data">
        
        <p style="text-align:center;"><strong>Abono Realizado</strong>                               
        <p>
          Nro Cuota: <?php echo $nro_cuota; ?> <br>
          Cliente: <?php echo $name_cst; ?> <br>
          Tipo moneda: <?php echo $coin; ?><br>
        </p>
        <div style="clear:both;"></div>
        <table class="table table-condensed">
          <thead>
            <tr>
              <th class="text-center" style="width: 50%; border-bottom: 2px solid #ddd;">Descripcion</th>
              <th class="text-center" style="width: 24%; border-bottom: 2px solid #ddd;">Monto Abonado</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td>Abono N° <?php echo 1 ?></td>
                <td class="text-right"><?php echo $abono ?></td>
              </tr>
          </tbody>
          </table>
          <table class="table table-striped table-condensed" style="margin-top:10px;">
            <tbody>
              <tr>
                <td class="text-center">Pagado por : Efectivo</td>
              </tr>
            </tbody>
          </table>
        </div>
      <?php
      
        }else{
      ?>
        <div id="receipt-data">
        
        <p style="text-align:center;"><strong>Pago Realizado</strong>                               
        <p>
          Fecha/hora:  <?php echo $cuotas[0]->pay_date; $total = 0; ?><br>
          N° Prestamo: <?php echo $loan_id; ?> <br>
          Cliente: <?php echo $name_cst; ?> <br>
          Tipo moneda: <?php echo $coin; ?><br>
        </p>
        <div style="clear:both;"></div>
        <table class="table table-condensed">
          <thead>
            <tr>
              <th class="text-center" style="width: 50%; border-bottom: 2px solid #ddd;">Descripcion</th>
              <th class="text-center" style="width: 24%; border-bottom: 2px solid #ddd;">Monto Cancelado</th>
              <th class="text-center" style="width: 26%; border-bottom: 2px solid #ddd;">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cuotas as $qp): ?>
              <tr>
                <td>Cuota N° <?php echo $qp->num_quota ?></td>
                <td class="text-right"><?php echo $qp->fee_amount; $total+=$qp->fee_amount;  ?></td>
                <td class="text-right"><?php echo $qp->fee_amount ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th class="text-right"><?php echo $total ?></th>
            </tr>
          </tfoot>
          </table>
          <table class="table table-striped table-condensed" style="margin-top:10px;">
            <tbody>
              <tr>
                <td class="text-center">Pagado por : Efectivo</td>
              </tr>

            </tbody>
          </table>
    
        
        </div>
      <?php
      
        }
      ?>

        <!-- start -->
        <div id="buttons" style="text-transform:uppercase;" class="no-print">
        <hr>
        <span class="col-xs-12">
            <button onclick="window.print();" class="btn btn-block btn-primary">Imprimir</button></span>

            <span class="col-xs-12">
            <a class="btn btn-block btn-success" href="<?php echo site_url('admin/payments/'); ?>">Listar Pagos</a>
            </span>
            <div style="clear:both;"></div>
        </div>
        <!-- end -->
    </div>
  </div>
       
</body>
</html>
