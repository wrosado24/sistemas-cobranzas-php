<div class="card shadow mb-4">
  <div class="card-header py-3"><?php echo empty($lawyer->nombres) ? 'Nuevo Abogado' : 'Actualizar Abogado'; ?></div>
  <div class="card-body">
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
      <div class="form-group col-md-4">
        <label class="small mb-1" for="ci">C.I.</label>
        <input class="form-control" id="ci" type="text" name="ci" value="<?php echo set_value('ci', $this->input->post('ci') ? $this->input->post('ci') : $lawyer->ci); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="nombres">Nombres</label>
        <input class="form-control" id="nombres" type="text" name="nombres" value="<?php echo set_value('nombres', $this->input->post('nombres') ? $this->input->post('nombres') : $lawyer->nombres); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="apellidos">Apellidos</label>
        <input class="form-control" id="apellidos" type="text" name="apellidos" value="<?php echo set_value('apellidos', $this->input->post('apellidos') ? $this->input->post('apellidos') : $lawyer->apellidos); ?>">
      </div>

      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar departamento</label>
        <select class="form-control" id="department_id" name="department_id">
          <?php if ($lawyer->department_id == 0): ?>
            <option value = "" selected>Seleccionar departamento</option>
          <?php endif ?>
          <?php foreach ($departments as $dp): ?>
            <option value="<?php echo $dp->id ?>" <?php if ($dp->id == $lawyer->department_id) echo "selected" ?>><?php echo $dp->name ?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar provincia</label>
        <select class="form-control" id="province_id" name="province_id">
          <?php if ($lawyer->province_id == 0): ?>
            <option value = "" selected>Seleccionar provincia</option>
          <?php else: ?>
            <?php foreach ($provinces as $pr): ?>
              <option value="<?php echo $pr->id ?>" <?php if ($pr->id == $lawyer->province_id) echo "selected" ?>><?php echo $pr->name ?></option>
            <?php endforeach ?>
          <?php endif ?>
        </select>
      </div>
      
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar distrito</label>
        <select class="form-control" id="district_id" name="district_id">
          <?php if ($lawyer->district_id == 0): ?>
            <option value = "" selected>Seleccionar distrito</option>
          <?php else: ?>
            <?php foreach ($districts as $ds): ?>
              <option value="<?php echo $ds->id ?>" <?php if ($ds->id == $lawyer->district_id) echo "selected" ?>><?php echo $ds->name ?></option>
            <?php endforeach ?>
          <?php endif ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label class="small mb-1" for="genero">Genero</label>
        <select class="form-control" id="genero" name="genero">

          <?php if ($lawyer->genero == 'none'): ?>
            <option value = "" selected>Seleccionar genero</option>
          <?php endif ?>

          <option value="MASCULINO" <?php if ($lawyer->genero == 'MASCULINO') echo "selected" ?>>
            MASCULINO
          </option>
          <option value="FEMENINO" <?php if ($lawyer->genero == 'FEMENINO') echo "selected" ?>>
            FEMENINO
          </option>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label class="small mb-1" for="direccion">Direccion</label>
        <input class="form-control" id="direccion" type="text" name="direccion" value="<?php echo set_value('direccion', $this->input->post('direccion') ? $this->input->post('direccion') : $lawyer->direccion); ?>">
      </div>

      <div class="form-group col-md-4">
        <label class="small mb-1" for="celular">Celular</label>
        <input class="form-control" id="celular" type="text" name="celular" value="<?php echo set_value('celular', $this->input->post('celular') ? $this->input->post('celular') : $lawyer->celular); ?>">
      </div>


    </div>

    <button class="btn btn-primary" type="submit"><?php echo empty($lawyer->nombres) ? 'Registrar Abogado' : 'Actualizar Abogado'; ?></button>
    <a href="<?php echo site_url('admin/lawyers/'); ?>" class="btn btn-dark">Cancelar</a>
    
    <?php echo form_close() ?>
  </div>
</div>