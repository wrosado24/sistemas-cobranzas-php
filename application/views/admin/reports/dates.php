<div class="card shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary">Reporte de prestamos por rango de fechas</h6>
  </div>
  <div class="card-body">

    <div class="form-row">

      <div class="form-group col-md-3">

        <label class="small mb-1" for="exampleFormControlSelect2">Fecha inicio</label>
        <input type="date" id="start_d" class="form-control">
      </div>

      <div class="form-group col-md-3">

        <label class="small mb-1" for="exampleFormControlSelect2">Fecha final</label>
        <input type="date" id="end_d" class="form-control">
      </div>

      <div class="form-group col-md-3">
        <label class="small mb-1" for="exampleFormControlSelect2">Tipo de moneda</label>
        <select class="form-control" id="coin_type2" name="coin_type2">
          <?php foreach ($coins as $c): ?>
            <option value="<?php echo $c->id ?>"><?php echo $c->name.' ('.strtoupper($c->short_name).')' ?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="form-group col-md-3 d-flex justify-content-end align-items-end">
        <a class="btn btn-success shadow-sm" href="javascript:reportPDF()"><i class="fas fa-print fa-sm"></i> Imprimir</a>
      </div>

    </div>
    
  </div>
</div>