<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_m extends MY_Model {

  protected $_table_name = 'customers';

  public $customer_rules = array(
    array(
      'field' => 'dni',
      'label' => 'dni',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'first_name',
      'label' => 'nombre(s)',
      'rules' => 'trim|required'
    ),
    array(
      'field' => 'last_name',
      'label' => 'apellido(s)',
      'rules' => 'trim|required'
    )
  );

  public function get_new()
  {
    $customer = new stdClass(); //clase vacia
    $customer->dni = '';
    $customer->first_name = '';
    $customer->last_name = '';
    $customer->gender = 'none';
    $customer->department_id = 0;
    $customer->province_id = 0;
    $customer->district_id = 0;
    $customer->address = '';
    $customer->mobile = '';
    $customer->phone = '';
    $customer->business_name = '';
    $customer->ruc = '';
    $customer->company = '';

    return $customer;
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

/* End of file Customers_m.php */
/* Location: ./application/models/Customers_m.php */