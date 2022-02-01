<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('payments_m');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['payments'] = $this->payments_m->get_payments();
    $data['subview'] = 'admin/payments/index';

    $this->load->view('admin/_main_layout', $data);
  }

  public function edit()
  {
    $data['subview'] = 'admin/payments/edit';
    $this->load->view('admin/_main_layout', $data);
  }

  function ajax_searchCst() 
  {
    $dni = $this->input->post('dni');
    $cst = $this->payments_m->get_searchCst($dni);
    $quota_data = '';

    if ($cst != null) {
      $quota_data = $this->payments_m->get_quotasCst($cst->loan_id);
    } 

    $search_data = ['cst' => $cst, $quota_data];

    echo json_encode($search_data);
  }

  function ticket()
  {
    $data['name_cst'] = $this->input->post('name_cst');
    $data['coin'] = $this->input->post('coin');
    $data['loan_id'] = $this->input->post('loan_id');
    $monto_total = $this->input->post('monto_total');
    $abono_monto = $this->input->post('abono');
    $habilitar_abono = $this->input->post('chkAbono');
    $cuotas = $this->input->post('quota_id');

    if($habilitar_abono == "on"){

      if($abono_monto != "" && $abono_monto > 0){ 

        $data["pagoAbono"] = true;
        $data["abono"] = $abono_monto;

        foreach($cuotas as $id){         
          //datos para el insert
          $data_pago_abono["abono"] = $abono_monto; 
          $data_pago_abono["loan_item_id"] = $id; 
          //OBTENER EL TOTAL DE ABONOS HECHOS PARA UNA CUOTA
          $sumaTotalAbonos = 0;

          $array_abonos = json_decode(json_encode($this->payments_m->obtenerTotalAbono($id)));

          for($i=0;$i<sizeof($array_abonos);$i++){
            $sumaTotalAbonos+=$array_abonos[$i]->abono;
          }

          $data["totalAbonos"] = $sumaTotalAbonos;

          //OBTENER EL VALOR DE LA CUOTA
          $valor_cuota = json_decode(json_encode($this->payments_m->obtenerValorDeCuotaPorId($id)))[0]->fee_amount;
          $data["valor_cuota"] = $valor_cuota;
          $data["nro_cuota"] = $id;

          if($abono_monto <= $valor_cuota){
            $operacionLimite = $sumaTotalAbonos+$abono_monto;
            if($operacionLimite < $valor_cuota){
              $this->payments_m->insertar_abonos($data_pago_abono);
              $array_abonos = json_decode(json_encode($this->payments_m->obtenerTotalAbono($id)));
              for($i=0;$i<sizeof($array_abonos);$i++){
                $sumaTotalAbonos+=$array_abonos[$i]->abono;
              }
              $data["totalAbonos"] = $sumaTotalAbonos;
              //cuota aun pendiente, pero con un monto abonado
              $data['cuotas'] = $this->payments_m->obtener_cuotas_pago_con_abono($this->input->post('quota_id'));
              $this->load->view('admin/payments/ticket', $data);
            }else if($operacionLimite = $valor_cuota){
              $array_abonos = json_decode(json_encode($this->payments_m->obtenerTotalAbono($id)));
              for($i=0;$i<sizeof($array_abonos);$i++){
                $sumaTotalAbonos+=$array_abonos[$i]->abono;
              }
              $data["totalAbonos"] = $sumaTotalAbonos;
              //cuota pagada
              $this->payments_m->insertar_abonos($data_pago_abono);
              $this->payments_m->paga_cuota_con_abono(['status' => 0], $id);
              if (!$this->payments_m->check_cstLoan($this->input->post('loan_id'))) {
                $this->payments_m->update_cstLoan($this->input->post('loan_id'), $this->input->post('customer_id'));
              }
              $data['cuotas'] = $this->payments_m->obtener_cuotas_pago_con_abono($this->input->post('quota_id'));
              $this->load->view('admin/payments/ticket', $data);
            }else{
              echo "Ha ocurrido un error. Volver a intentarlo.";
            }
          }else{
            echo "El valor abonado ha sobrepasado el limite de la cuota. Vuelva a intentarlo.";
          }
        }
      }else{
        echo "<span>El monto del abono no es correcto.</span>";
      }


    }else{
      $data["pagoAbono"] = false;

      foreach ($this->input->post('quota_id') as $q) {
        $this->payments_m->actualizar_cuota_sin_abono(['status' => 0], $q);
      }

      if (!$this->payments_m->check_cstLoan($this->input->post('loan_id'))) {
        $this->payments_m->update_cstLoan($this->input->post('loan_id'), $this->input->post('customer_id'));
      }

      $data['cuotas'] = $this->payments_m->obtener_cuotas_pago_sin_abono($this->input->post('quota_id'));
  
      $this->load->view('admin/payments/ticket', $data);

    }
    
  }

}

/* End of file Payments.php */
/* Location: ./application/controllers/admin/Payments.php */