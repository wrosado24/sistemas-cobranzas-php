$(document).ready(function() {

  $("#department_id").change(function(){
  
    dp_id = $("#department_id").val()
  
    $.get(base_url + "admin/customers/ajax_getProvinces/" + dp_id, function(data){
      $("#province_id").html(data);
    });
  });

  $("#province_id").change(function(){

    pr_id = $("#province_id").val()
  
    $.get(base_url + "admin/customers/ajax_getDistricts/" + pr_id, function(data){
      $("#district_id").html(data);
    });
  });

  var callback = function() {

    var dni = $('#dni').val()

    if (dni == "") {
      alert('ingresar C.I.')
      return false
    } else {

      $.post(base_url + "admin/loans/ajax_searchCst/", {dni : dni}, function(data){

        console.log('sin parse', data)

        if (data == 'null'){
          $("#dni").val('');
          alert('No existe el cliente');
          $("#dni_cst").val('');
          $("#name_cst").val('');
          $("#customer").val('');
        }
        else
        {
          $("#dni").val('');
          // debes validar/procesar esa cadena como JSON (con JSON.parse) y entonces podrás acceder a los datos de manera sencilla.
          data = JSON.parse(data);    
         
          console.log('con parse', data)
          
          if (data.loan_status == '0') {
            $("#customer").val(data.id);
            $("#dni_cst").val(data.dni);
            $("#name_cst").val(data.first_name + ' ' +data.last_name);
          } else {
            alert('persona con prestamo pendiente')
            $("#dni_cst").val('');
            $("#name_cst").val('');
            $("#customer").val('');
          }
          
        }
        
      })
    }

  };

  var callbackCiDataJudicial = function() {
    
    const ci = $("#ci_c_dj").val();
    console.log("ci: " + ci);

    if(ci == "" || ci == null){
      alert("Ingresa el CI del cliente");
    }else{

      $.post(base_url + "admin/datajudicial/ajax_searchCst/", {ci : ci}, function(data){

        if (data == 'null'){
          alert("Este cliente no existe, buscar otro.");
        }
        else{
          const response = JSON.parse(data);
          $("#ci_dj").val(response.dni);
          $("#nombres_dj").val(response.first_name);
          $("#apellidos_dj").val(response.last_name);
          $("#customer_id").val(response.id);
        }
        
      })
    }

  }
  $("#chkAbono").prop("checked", false);
  $("#chkAbono").change(function() {
    if($("#total_amount").val() > 0){
      if(this.checked) {
        $("#abono").prop("readonly", false);
        $("#abono").val('');
      }else{
        $("#abono").prop("readonly", true);
        $("#abono").val('');
      }
    }else{
      alert("Tu monto total es 0. Selecciona las cuotas a pagar.");
      $("#chkAbono").prop("checked", false);
    }
  });

  $("#dni").keypress(function(event) {
    if (event.which == 13) callback();
  });

  $('#btn_buscar').click(callback);
  $('#bttn_buscar_cliente_datajuidicial').click(callbackCiDataJudicial);

  $('#calcular').on('click', function(){ 
    // var define una variable global o local en una función sin importar el ámbito del bloque
    var contador = 0

    if ($("#cr_amount").val()=="") {
      contador=1  
      alert("Ingresar monto")
      $("#cr_amount").focus()
      return false;
    }
    if ($("#in_amount").val()=="") {
      contador=1 
      alert("Ingresar interes")
      $("#in_amount").focus()
      return false;
    }
    if ($("#fee").val()=="") {
      contador=1 
      alert("Ingresar cuotas")
      $("#fee").focus()
      return false;
    }
    if ($("#date").val()=="") {
      contador=1 
      alert("Ingresar fecha emision")
      return false;
    }

    if (contador==0) {
      $('#register_loan').attr('disabled', false);
    }
    // let permite almacenar los datos de una forma más eficiente
    let monto = parseFloat($('#cr_amount').val());
    let interes = $('#in_amount').val();
    let num_cuotas = $('#fee').val();
    let interes_final = monto * (interes / 100);
    let monto_total = interes_final + monto;
    let cuota = monto_total / num_cuotas;

    $('#valor_cuota').val(cuota.toFixed(2));
    $('#valor_interes').val(interes_final.toFixed(2));
    $('#monto_total').val(monto_total.toFixed(2));

  });

  $("#loan_form").submit(function () {  
    if($("#customer").val() == "") {  
      alert("Buscar un cliente");  
      return false;  
    }  
    
  });

  $(document).on("click", '[data-toggle="ajax-modal"]', function (t) {
    t.preventDefault();
   
    var url = $(this).attr("href");

    $.get(url).done(function (data) {
      $("#myModal").html(data).modal({ backdrop: "static" });
    })
   
  })

  // buscar cliente cobranza
  var callback_cobranza = function() {

    var dni_c = $('#dni_c').val()

    if (dni_c == "") {

      alert('ingresar C.I.')
      return false

    } else {

      $.post(base_url + "admin/payments/ajax_searchCst/", {dni : dni_c}, function(data){
        
        console.log('sin parse', data)

        data = JSON.parse(data);

        console.log('con parse', data)

        if (data.cst == null){

          $("#dni_c").val('');
          $("#dni_cst").val('');
          $("#name_cst").val('');
          $("#credit_amount").val('');
          $("#payment_m").val('');
          $("#coin").val('');

          alert('No existe el cliente o no tiene prestamo');
          $("#quotas").html('');
          $("#quotas").dataTable().fnDestroy();
        }
        else {

          $("#dni_c").val('');
          $("#dni_cst").val(data.cst.dni);
          $("#name_cst").val(data.cst.cst_name);
          $("#customer_id").val(data.cst.customer_id);
          $("#loan_id").val(data.cst.loan_id);
          $("#credit_amount").val(data.cst.credit_amount);
          $("#payment_m").val(data.cst.payment_m);
          $("#coin").val(data.cst.coin_name);

           // clear the table before populating it with more data
          $("#quotas").dataTable().fnDestroy();

          $('#quotas').dataTable({

            "bPaginate": false, //Ocultar paginación
            "scrollY": '50vh',
            "scrollCollapse": true,
            "aaData": data[0],
            
          })

          $('input:checkbox').on('change',function (){
            var total = 0;
            $('input:checkbox:enabled:checked').each(function(){
              total += isNaN(parseFloat($(this).attr('data-fee'))) ? 0 : parseFloat($(this).attr('data-fee'));
              if(isNaN(parseFloat($(this).attr('data-fee')))){
                
              }
            });   
            
            $("#total_amount").val(total);

            if (total != 0) {
              $('#register_loan').attr('disabled', false);
            } else {
              $('#register_loan').attr('disabled', true);
            }

          });
        }
      })
    }

  };

  $("#dni_c").keypress(function() {
      if (event.which == 13) callback_cobranza();
  });

  $('#btn_buscar_c').click(callback_cobranza);

  $("#coin_type").change(function(){
    
    var coin_id = $("#coin_type").val()
    var symbol = $('#coin_type option:selected').data("symbol");
  
    $.get(base_url + "admin/reports/ajax_getCredits/" + coin_id, function(data){
   
      data = JSON.parse(data);
      console.log('con parse', data)

      if (data.credits[0].sum_credit == null) {
        var sum_credit = '0 ' + symbol.toUpperCase()
      } else {
        var sum_credit = data.credits[0].sum_credit + ' ' + (data.credits[0].short_name).toUpperCase()
      }
      $("#cr").html(sum_credit)

      if (data.credits[1].cr_interest == null) {
        var cr_interest = '0 ' + symbol.toUpperCase()
      } else {
        var cr_interest = data.credits[1].cr_interest + ' ' + (data.credits[1].short_name).toUpperCase()
      }
      $("#cr_interest").html(cr_interest)

      if (data.credits[2].cr_interestPaid == null) {
        var cr_interestPaid = '0 ' + symbol.toUpperCase()
      }else{
        var cr_interestPaid = data.credits[2].cr_interestPaid + ' ' + data.credits[2].short_name.toUpperCase()
      }
      $("#cr_interestPaid").html(cr_interestPaid)

      if (data.credits[3].cr_interestPay == null) {
        var cr_interestPay = '0 ' + symbol.toUpperCase()
      } else {
        var cr_interestPay = data.credits[3].cr_interestPay + ' ' + (data.credits[3].short_name).toUpperCase()
      }
      $("#cr_interestPay").html(cr_interestPay)

    });
  });

})

function imp_credits(imp1){
  var printContents = document.getElementById('imp1').innerHTML;
  w = window.open();
  w.document.write(printContents);
  w.print();
  w.close();
}

function reportPDF(){
  var start_d = $("#start_d").val();
  var end_d = $("#end_d").val();
  var coin_t = $("#coin_type2").val();

  if (start_d == '' || end_d == '') {
    alert('ingrese las fechas')
  }else{
    window.open(base_url+'admin/reports/dates_pdf/'+coin_t+'/'+start_d+'/'+end_d)
  }

}

