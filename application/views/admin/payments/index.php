<div class="card shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary">Listar Pagos</h6>
    <a class="d-sm-inline-block btn btn-sm btn-success shadow-sm" href="<?php echo site_url('admin/payments/edit'); ?>"><i class="fas fa-plus-circle fa-sm"></i> Realizar Pago</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>C.I.</th>
            <th>cliente</th>
            <th>N° Prest.</th>
            <th>N° cuota</th>
            <th>M. Pagado</th>
            <th>Fecha pago</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($payments)): foreach($payments as $py): ?>
            <tr>
              <td><?php echo $py->dni ?></td>
              <td><?php echo $py->name_cst ?></td>
              <td><?php echo $py->loan_id ?></td>
              <td><?php echo $py->num_quota ?></td>
              <td><?php echo $py->fee_amount ?></td>
              <td><?php echo $py->pay_date ?></td>
            </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">No existen pagos, registrar un nuevo pago.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>