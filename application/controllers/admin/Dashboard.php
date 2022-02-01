<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('config_m');
    $this->load->library('session');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['qCts'] = $this->config_m->get_countCts();
    $data['qLoans'] = $this->config_m->get_countLoans();
    $data['qPaids'] = $this->config_m->get_countPaids();

    $count_lc = $this->config_m->get_countLC();

    $data_lc = [];
 
    foreach($count_lc as $row) {
      $data_lc['label'][] = $row->name;
      $data_lc['data'][] = (int) $row->total;
    }

    $data['countLC'] = json_encode($data_lc);

    $data['subview'] = 'admin/index';
    $this->load->view('admin/_main_layout', $data);
  }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */