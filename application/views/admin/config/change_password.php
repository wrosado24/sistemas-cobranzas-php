<div class="card shadow mb-4">
  <div class="card-header py-3">Cambiar contraseña</div>
  <div class="card-body">
    <?php if ($this->session->flashdata('msg')): ?>
      <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <?= $this->session->flashdata('msg') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>
    <?php if(validation_errors()) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo validation_errors('<li>', '</li>'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <?php echo form_open(); ?>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label class="small mb-1" for="inputUsername">Contraseña anterior</label>
          <input class="form-control" id="inputUsername" type="password" name="old_password">
        </div>
        <div class="form-group col-md-12">
          <label class="small mb-1" for="exampleFormControlarea1">Nueva contraseña </label>
          <input class="form-control" id="inputUsername" type="password" name="new_password">
        </div>
        <div class="form-group col-md-12">
          <label class="small mb-1" for="exampleFormControlTextarea1">Confirmar contraseña</label>
          <input class="form-control" id="inputUsername" type="password" name="confirm_password">
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Cambiar contraseña</button>
      <a href="<?php echo site_url('admin/dashboard/'); ?>" class="btn btn-dark">Cancelar</a>
    <?php echo form_close() ?>
  </div>
</div>