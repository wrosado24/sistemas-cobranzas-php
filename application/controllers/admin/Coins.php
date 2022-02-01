<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coins extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('coins_m');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['coins'] = $this->coins_m->get();
    $data['subview'] = 'admin/coins/index';

    $this->load->view('admin/_main_layout', $data);
  }

  public function edit($id = NULL)
  {
    if ($id) {
      $data['coin'] = $this->coins_m->get($id);
    } else {
      $data['coin'] = $this->coins_m->get_new();
    }

    $rules = $this->coins_m->coin_rules;
   
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {

      $coin_data = $this->coins_m->array_from_post(['name','short_name', 'symbol', 'description']);
      
      $this->coins_m->save($coin_data, $id);

      if ($id) {
        $this->session->set_flashdata('msg', 'Moneda editado correctamente');
      } else {
        $this->session->set_flashdata('msg', 'Moneda agregado correctamente');
      }
      
      redirect('admin/coins');

    }

    $data['subview'] = 'admin/coins/edit';
    $this->load->view('admin/_main_layout', $data);
  }

}

/* End of file Coins.php */
/* Location: ./application/controllers/admin/Coins.php */