<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('config_m');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['user'] = $this->config_m->get($this->session->userdata('user_id'));

    $rules = $this->config_m->config_rules;
   
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {

      $user_data = $this->config_m->array_from_post(['first_name', 'last_name', 'email']);
      
      $this->config_m->save($user_data, $this->session->userdata('user_id'));

      $this->session->set_flashdata('msg', 'usuario editado correctamente');
      
      redirect('admin/config');

    }

    $data['subview'] = 'admin/config/index';
    $this->load->view('admin/_main_layout', $data);
  }

  public function change_password()
  {
    $rules = $this->config_m->password_rules;
   
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {

      $password_data = ['password' => $this->config_m->hash($this->input->post('new_password'))];
      
      $this->config_m->save($password_data, $this->session->userdata('user_id'));

      $this->session->set_flashdata('msg', 'constraseña editada correctamente');
      
      redirect('admin/config/change_password');

    }

    $data['subview'] = 'admin/config/change_password';
    $this->load->view('admin/_main_layout', $data);
  }

  public function _password_verify($old_password)
  {
    $user = $this->config_m->get($this->session->userdata('user_id'));
    if ($user->password != $this->config_m->hash($old_password)) {
      $this->form_validation->set_message('_password_verify', 'La contraseña anterior no coincide con su actual contraseña');
      return FALSE;
    } else {
      return TRUE;
    }
    
  }

}

/* End of file Config.php */
/* Location: ./application/controllers/admin/Config.php */