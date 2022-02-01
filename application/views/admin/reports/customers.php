<div class="card shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary">Reporte global por clientes</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>C.I.</th>
            <th>Nombre completo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($customers)): foreach($customers as $ct): ?>
            <tr>
              <td><?php echo $ct->dni ?></td>
              <td><?php echo $ct->customer ?></td>
              <td>
                <a href="<?php echo site_url('admin/reports/customer_pdf/'.$ct->id); ?>" target="_blank" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-eye fa-sm"></i> Ver estado de prestamo</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">No existen Clientes con prestamo</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>