<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_m extends MY_Model {

  protected $_table_name = 'users';

  public $config_rules = array(
    array(
      'field' => 'first_name',
      'label' => 'nombre(s)',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'last_name',
      'label' => 'apellido(s)',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'email',
      'label' => 'correo electronico',
      'rules' => 'trim|required'
    )
  );

  public $password_rules = array(
    array(
      'field' => 'old_password',
      'label' => 'contraseña anterior',
      'rules' => 'trim|required|callback__password_verify'
    ),
    array(
      'field' => 'new_password',
      'label' => 'nueva contraseña',
      'rules' => 'trim|matches[confirm_password]'
    ),
    array(
      'field' => 'confirm_password',
      'label' => 'confirmar contraseña',
      'rules' => 'trim|required'
    )
  );

  public function get_countCts()
  {
    $this->db->select("count(*) as cantidad");
    $this->db->from('customers');

    return $this->db->get()->row(); 
  }

  public function get_countLoans()
  {
    $this->db->select("count(*) as cantidad");
    $this->db->from('loans');
    $this->db->where('status', 1);

    return $this->db->get()->row(); 
  }

  public function get_countPaids()
  {
    $this->db->select("count(*) as cantidad");
    $this->db->from('loans');
    $this->db->where('status', 0);

    return $this->db->get()->row(); 
  }

  public function get_countLC()
  {
    $this->db->select("c.name, c.short_name, count(l.id) as total");
    $this->db->from('loans l');
    $this->db->join('coins c', 'c.id = l.coin_id', 'left');
    $this->db->group_by('l.coin_id');

    return $this->db->get()->result(); 
  }
}

/* End of file config_m.php */
/* Location: ./application/models/config_m.php */