
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">
        Prestamo # <?php echo $loan->id ?>
        <br>
        cliente: <?= $loan->customer_name; ?>
        </h5>
      <div class="d-flex flex-row-reverse">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times fa-sm"></i></button>
        <button type="button" class="close" onclick="window.print();"><i class="fas fa-print fa-sm"></i></button>
      </div>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <div class="clearfix mb-2">
              <div class="float-left">
                Monto Credito: <?= $loan->credit_amount; ?>
                <br>
                Interes Credito: <?= $loan->interest_amount.'%'; ?>
                <br>
                Nro cuotas: <?= $loan->num_fee; ?>
                <br>
                Monto cuota: <?= $loan->fee_amount; ?>
                <br>
                tipo moneda: <?= strtoupper($loan->short_name); ?>
                <br>
              </div>
              <div class="float-right">
                Fecha Credito: <?= $loan->date; ?>
                <br>
                Forma Pago: <?= $loan->payment_m; ?>
                <br>
                Estado Credito: <?= $loan->status ? 'Pendiente': 'Pagado'; ?>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-striped table-condensed">
                <thead>
                  <tr class="active">
                    <th>Nro Cuota</th>
                    <th class="col-xs-2">Fecha Pago</th>
                    <th class="col-xs-2 text-right">Total pagar</th>
                    <th class="col-xs-2 text-center">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($items) {
                    $i = 0;
                    foreach ($items as $item) {
                      echo '<tr>';
                      echo '<td>'.++$i.'</td>';
                      echo '<td>'.$item->date.'</td>';
                      echo '<td class="text-right">'.$item->fee_amount.'</td>';
                      $status = ($item->status) ? 'Pendiente' : 'Pagado' ;
                      echo '<td class="text-center">'.$status.'</td>';
                      echo '</tr>';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
