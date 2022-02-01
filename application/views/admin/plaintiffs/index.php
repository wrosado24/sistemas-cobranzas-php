<div class="card shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary">Listado de Demandantes</h6>
    <a class="d-sm-inline-block btn btn-sm btn-success shadow-sm" href="<?php echo site_url('admin/plaintiffs/edit'); ?>"><i class="fas fa-plus-circle fa-sm"></i> Nueva Demandante</a>
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
          <?php if(count($plaintiffs)): foreach($plaintiffs as $plffs): ?>
            <tr>
              <td><?php echo $plffs->ci ?></td>
              <td><?php echo $plffs->nombres ?></td>
              <td><?php echo $plffs->apellidos ?></td>
              <td><?php echo $plffs->genero ?></td>
              <td><?php echo $plffs->direccion ?></td>
              <td><?php echo $plffs->celular ?></td>
              <td style="text-align:center;">
                <a href="<?php echo site_url('admin/plaintiffs/edit/'.$plffs->id); ?>" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-edit fa-sm"></i> Editar</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">No existen Demandantes, agregar un nuevo demandante.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>