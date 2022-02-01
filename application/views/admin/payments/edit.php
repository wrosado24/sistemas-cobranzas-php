<div class="card shadow mb-4">
  <div class="card-header py-3">Pagar cuotas del prestamo </div>
  <div class="card-body">

    <?php echo form_open('admin/payments/ticket'); ?>

      <div class="form-row">
        <div class="form-group col-12 col-md-8">
          <label class="small mb-1" for="exampleFormControlSelect2">Buscar cliente por C.I.</label>
          <div class="input-group">
            <input type="text" id="dni_c" class="form-control">
            <input type="hidden" name="loan_id" id="loan_id">
            <input type="hidden" name="customer_id" id="customer_id">
            <div class="input-group-append">
              <button type="button" id="btn_buscar_c" class="btn btn-primary">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-12 col-md-4">
          <label class="small mb-1" for="inputUsername">C.I.</label>
          <input class="form-control" id="dni_cst" type="text" disabled>
        </div>
        <div class="form-group col-12 col-md-4">
          <label class="small mb-1" for="inputUsername">Nombre completo</label>
          <input class="form-control" id="name_cst" name="name_cst" type="text" readonly>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-12 col-md-4">
          <label class="small mb-1" for="inputUsername">Monto prestado</label>
          <input class="form-control" id="credit_amount" type="text" disabled>
        </div>
        <div class="form-group col-12 col-md-4">
          <label class="small mb-1" for="inputUsername">Forma de pago</label>
          <input class="form-control" id="payment_m" type="text" disabled>
        </div>
        <div class="form-group col-12 col-md-4">
          <label class="small mb-1" for="exampleFormControlTextarea1">Tipo moneda</label>
          <input class="form-control" id="coin" name="coin" type="text" readonly>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-12 col-md-8">
          <table class="table table-bordered" id="quotas" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox"></th>
                <th>N° cuota</th>
                <th>Fecha de pago</th>
                <th>Monto cuota</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <div class="form-group col-12 col-md-4 text-center">

        <label class="small mb-1" for="exampleFormControlTextarea1">Monto Total</label>
          <input class="form-control mb-3 text-center" style="font-weight: bold; font-size: 1.2rem;" id="total_amount" name="monto_total" type="number" readonly>
          <input type="checkbox" id="chkAbono" name="chkAbono">
          <label class="small mb-1" for="exampleFormControlTextarea1">Abono</label>
          <input class="form-control mb-3 text-center" style="font-weight: bold; font-size: 1.2rem;"  id="abono" name="abono" type="text" readonly>

          <div class="row">
            <div class="col-6">
              <button class="btn btn-success btn-block" id="register_loan" type="submit" disabled>Registrar Pago</button>
            </div>
            <div class="col-6">
              <a href="<?php echo site_url('admin/payments/'); ?>" class="btn btn-dark btn-block">Cancelar</a>
            </div>  
          </div>
        </div>
      </div>

    <?php echo form_close() ?>

    </div>
  </div>