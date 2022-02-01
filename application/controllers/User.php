<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('user_m');
  }

  public function login()
  {
    $dashboard = 'admin/dashboard';
    $this->user_m->loggedin() == FALSE || redirect($dashboard);

    $rules = $this->user_m->rules;
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {
      
      if ($this->user_m->login() == TRUE) {
        redirect($dashboard);
      }else{
        $this->session->set_flashdata('msg', 'Escribir correctamente su email o password');
        redirect('user/login', 'refresh');
      }
      
    }

    $this->load->view('_login_layout');
  }

  public function logout()
  {
    $this->user_m->logout();
    redirect('user/login');
  }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */