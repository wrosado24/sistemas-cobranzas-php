<div class="card shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary">Listado de Abogados</h6>
    <a class="d-sm-inline-block btn btn-sm btn-success shadow-sm" href="<?php echo site_url('admin/lawyers/edit'); ?>"><i class="fas fa-plus-circle fa-sm"></i> Nueva Abogado</a>
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
            <th>C.I.</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Genero</th>
            <th>Direccion</th>
            <th>Celular</th>
            <th style="text-align:center;">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($lawyers)): foreach($lawyers as $lwy): ?>
            <tr>
              <td><?php echo $lwy->ci ?></td>
              <td><?php echo $lwy->nombres ?></td>
              <td><?php echo $lwy->apellidos ?></td>
              <td><?php echo $lwy->genero ?></td>
              <td><?php echo $lwy->direccion ?></td>
              <td><?php echo $lwy->celular ?></td>
              <td style="text-align:center;">
                <a href="<?php echo site_url('admin/lawyers/edit/'.$lwy->id); ?>" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-edit fa-sm"></i> Editar</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">No existen abogados, agregar un nuevo abogado.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>