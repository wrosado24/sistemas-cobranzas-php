<div class="card shadow mb-4">
  <div class="card-header py-3"><?php echo empty($customer->first_name) ? 'Nuevo Cliente' : 'Editar Cliente'; ?></div>
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
      <div class="form-group col-md-3">
        <label class="small mb-1" for="inputUsername">Ingresar C.I.</label>
        <input class="form-control" id="inputUsername" type="text" name="dni" value="<?php echo set_value('dni', $this->input->post('dni') ? $this->input->post('dni') : $customer->dni); ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="small mb-1" for="inputUsername">Ingresar Nombre</label>
        <input class="form-control" id="inputUsername" type="text" name="first_name" value="<?php echo set_value('first_name', $this->input->post('first_name') ? $this->input->post('first_name') : $customer->first_name); ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="small mb-1" for="exampleFormControlTextarea1">Ingresar Apellidos</label>
        <input class="form-control" id="inputUsername" type="text" name="last_name" value="<?php echo set_value('last_name', $this->input->post('last_name') ? $this->input->post('last_name') : $customer->last_name); ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar Genero</label>
        <select class="form-control" id="exampleFormControlSelect2" name="gender">

          <?php if ($customer->gender == 'none'): ?>
            <option value = "" selected>Seleccionar genero</option>
          <?php endif ?>

          <option value="masculino" <?php if ($customer->gender == 'masculino') echo "selected" ?>>
            masculino
          </option>
          <option value="femenino" <?php if ($customer->gender == 'femenino') echo "selected" ?>>
            femenino
          </option>
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar departamento</label>
        <select class="form-control" id="department_id" name="department_id">
          <?php if ($customer->department_id == 0): ?>
            <option value = "" selected>Seleccionar departamento</option>
          <?php endif ?>
          <?php foreach ($departments as $dp): ?>
            <option value="<?php echo $dp->id ?>" <?php if ($dp->id == $customer->department_id) echo "selected" ?>><?php echo $dp->name ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar provincia</label>
        <select class="form-control" id="province_id" name="province_id">
          <?php if ($customer->province_id == 0): ?>
            <option value = "" selected>Seleccionar provincia</option>
          <?php else: ?>
            <?php foreach ($provinces as $pr): ?>
              <option value="<?php echo $pr->id ?>" <?php if ($pr->id == $customer->province_id) echo "selected" ?>><?php echo $pr->name ?></option>
            <?php endforeach ?>
          <?php endif ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar distrito</label>
        <select class="form-control" id="district_id" name="district_id">
          <?php if ($customer->district_id == 0): ?>
            <option value = "" selected>Seleccionar distrito</option>
          <?php else: ?>
            <?php foreach ($districts as $ds): ?>
              <option value="<?php echo $ds->id ?>" <?php if ($ds->id == $customer->district_id) echo "selected" ?>><?php echo $ds->name ?></option>
            <?php endforeach ?>
          <?php endif ?>
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar direccion</label>
        <input class="form-control" id="inputUsername" type="text" name="address" value="<?php echo set_value('address', $this->input->post('address') ? $this->input->post('address') : $customer->address); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlTextarea1">Ingresar celular</label>
        <input class="form-control" id="inputUsername" type="text" name="mobile" value="<?php echo set_value('mobile', $this->input->post('mobile') ? $this->input->post('mobile') : $customer->mobile); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlTextarea1">Ingresar Telefono</label>
        <input class="form-control" id="inputUsername" type="text" name="phone" value="<?php echo set_value('phone', $this->input->post('phone') ? $this->input->post('phone') : $customer->phone); ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar razon social</label>
        <input class="form-control" id="inputUsername" type="text" name="business_name" value="<?php echo set_value('business_name', $this->input->post('business_name') ? $this->input->post('business_name') : $customer->business_name); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar Nit</label>
        <input class="form-control" id="inputUsername" type="text" name="ruc" value="<?php echo set_value('ruc', $this->input->post('ruc') ? $this->input->post('ruc') : $customer->ruc); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar empresa</label>
        <input class="form-control" id="inputUsername" type="text" name="company" value="<?php echo set_value('company', $this->input->post('company') ? $this->input->post('company') : $customer->company); ?>">
      </div>
    </div>
    <button class="btn btn-primary" type="submit">Registrar cliente</button>
    <a href="<?php echo site_url('admin/customers/'); ?>" class="btn btn-dark">Cancelar</a>
    
    <?php echo form_close() ?>
  </div>
</div>