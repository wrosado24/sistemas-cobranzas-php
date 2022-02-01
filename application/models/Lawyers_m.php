<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lawyers_m extends MY_Model {

  protected $_table_name = 'lawyers';

  public $lawyer_rules = array(
    array(
      'field' => 'nombres',
      'label' => 'Nombres',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'apellidos',
      'label' => 'Apellidos',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'ci',
      'label' => 'C.I',
      'rules' => 'trim|required'
    )
  );

  public function get_new()
  {
    $lawyer = new stdClass(); //clase vacia
    $lawyer->ci = '';
    $lawyer->nombres = '';
    $lawyer->apellidos = '';
    $lawyer->genero = 'none';
    $lawyer->department_id = 0;
    $lawyer->province_id = 0;
    $lawyer->district_id = 0;
    $lawyer->direccion = '';
    $lawyer->celular = '';

    return $lawyer;
  }

  public function get_departments()
  {
    return $this->db->get('ubigeo_departments')->result();
  }

  public function get_editProvinces($dp_id)
  {
    $this->db->where('department_id', $dp_id);
    return $this->db->get('ubigeo_provinces')->result();
  }

  public function get_editDistricts($pr_id)
  {
    $this->db->where('province_id', $pr_id);
    return $this->db->get('ubigeo_districts')->result();
  }

  public function get_provinces($dp_id)
  {
    $this->db->where('department_id', $dp_id);

    $query = $this->db->get('ubigeo_provinces'); //select * from ubigeo_proinces
    $output1 = '<option value="0">Seleccionar provincia</option>';

    foreach ($query->result() as $row) {
      $output1 .= '<option value="'.$row->id.'">'.$row->name.'</option>';
    }

    return $output1;
  }

  public function get_districts($pr_id)
  {
    $this->db->where('province_id', $pr_id);

    $query = $this->db->get('ubigeo_districts'); //select * from ubigeo_proinces
    $output1 = '<option value="0">Seleccionar distrito</option>';

    foreach ($query->result() as $row) {
      $output1 .= '<option value="'.$row->id.'">'.$row->name.'</option>';
    }

    return $output1;
  }

}