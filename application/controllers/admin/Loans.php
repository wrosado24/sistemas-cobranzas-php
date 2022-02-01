<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('loans_m');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['loans'] = $this->loans_m->get_loans();
    $data['subview'] = 'admin/loans/index';
    $this->load->view('admin/_main_layout', $data);
  }

  public function edit()
  {
    $data['coins'] = $this->loans_m->get_coins();
    $data['lawyers'] = $this->loans_m->get_lawyers();
    $data['plaintiffs'] = $this->loans_m->get_plaintiffs();

    $rules = $this->loans_m->loan_rules;

    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {

      if ($this->input->post('payment_m') == 'diario')
        $p = 'P1D';
      if ($this->input->post('payment_m') == 'semanal')
        $p = 'P7D';
      if ($this->input->post('payment_m') == 'quincenal')
        $p = 'P15D';
      if ($this->input->post('payment_m') == 'mensual')
        $p = 'P1M';
      
      // definir periodo de fechas
      $period = new DatePeriod( 
                    new DateTime($this->input->post('date')), // Donde empezamos a contar el periodo
                    new DateInterval($p), // Definimos el periodo a 1 día, 1mes
                    $this->input->post('num_fee'), // Aplicamos el numero de repeticiones
                    DatePeriod::EXCLUDE_START_DATE);

      $num_quota = 1; 

      foreach ($period as $date) {
        //echo $date->format('Y-m-d');
        $items[] = array(
          'date' => $date->format('Y-m-d'),
          'num_quota' => $num_quota++,
          'fee_amount' => $this->input->post('fee_amount')
        );
      }

      $loan_data = $this->loans_m->array_from_post(['customer_id','credit_amount', 'interest_amount', 'num_fee', 'fee_amount', 'payment_m', 'coin_id', 'date', 'nro_cta_bancaria','demandante',
        'abogado_responsable','estado_demanda', 'localidad', 'lugar_trabajo', 'fecha_ing_juzgado', 'juzgado']);

      if ($this->loans_m->add_loan($loan_data, $items)) {
      
        $this->session->set_flashdata('msg', 'Prestamo agregado correctamente');
      }

      redirect('admin/loans');
    }

    $data['subview'] = 'admin/loans/edit';
    $this->load->view('admin/_main_layout', $data);
  }

  function ajax_searchCst() 
  {
    $dni = $this->input->post('dni');
    $cst = $this->loans_m->get_searchCst($dni);
    
    echo json_encode($cst);
  }

  function view($id) 
  {
    $data['loan'] = $this->loans_m->get_loan($id);
    $data['items'] = $this->loans_m->get_loanItems($id);

    $this->load->view('admin/loans/view', $data);
  }

}

/* End of file Loans.php */
/* Location: ./application/controllers/admin/Loans.php */