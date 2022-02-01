<div class="card shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary">Listar Monedas</h6>
    <a class="d-sm-inline-block btn btn-sm btn-success shadow-sm" href="<?php echo site_url('admin/coins/edit'); ?>"><i class="fas fa-plus-circle fa-sm"></i> Nueva moneda</a>
  </div>
  <div class="card-body">
    <?php if ($this->session->flashdata('msg')): ?>
      <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <?= $this->session->flashdata('msg') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nom. moneda</th>
            <th>Abreviatura</th>
            <th>Simbolo</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($coins)): foreach($coins as $coin): ?>
            <tr>
              <td><?php echo $coin->name ?></td>
              <td><?php echo $coin->short_name ?></td>
              <td><?php echo $coin->symbol ?></td>
              <td><?php echo $coin->description ?></td>
              <td>
                <a href="<?php echo site_url('admin/coins/edit/'.$coin->id); ?>" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-edit fa-sm"></i> Editar</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center">No existen Monedas, agregar una nueva moneda.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>