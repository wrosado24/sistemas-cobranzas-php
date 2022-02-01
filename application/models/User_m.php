<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends MY_Model {

  protected $_table_name = 'users';

  public $rules = array(
    'email' => array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|valid_email'
    ),
    'password' => array(
      'field' => 'password',
      'label' => 'Contraseña',
      'rules' => 'trim|required'
    )
  );

  public function login()
  {
    $user = $this->get_by([
      'email' => $this->input->post('email'),
      'password' => $this->hash($this->input->post('password'))
    ], TRUE);
    
    if (null !== $user) {
      
      $data = [
        'user_id' => $user->id,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'loggedin' => TRUE
      ];

      $this->session->set_userdata($data);  

      return TRUE;
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
  }

  public function loggedin()
  {
    return (bool) $this->session->userdata('loggedin');
  }

}

/* End of file User_m.php */
/* Location: ./application/models/User_m.php */