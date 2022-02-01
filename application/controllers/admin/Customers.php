<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('customers_m');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['customers'] = $this->customers_m->get();
    $data['subview'] = 'admin/customers/index';
    $this->load->view('admin/_main_layout', $data);
  }

  public function edit($id = NULL)
  {
    if ($id) {
      $data['customer'] = $this->customers_m->get($id);
      $data['provinces'] = $this->customers_m->get_editProvinces($data['customer']->department_id);
      $data['districts'] = $this->customers_m->get_editDistricts($data['customer']->province_id);
    } else {
      $data['customer'] = $this->customers_m->get_new();
    }

    $data['departments'] = $this->customers_m->get_departments();

    $rules = $this->customers_m->customer_rules;
   
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {
      
      $cst_data = $this->customers_m->array_from_post(['dni','first_name', 'last_name', 'gender', 'department_id', 'province_id', 'district_id', 'mobile', 'address', 'phone', 'business_name', 'ruc', 'company']);
      
      $this->customers_m->save($cst_data, $id);

      if ($id) {
        $this->session->set_flashdata('msg', 'Cliente editado correctamente');
      } else {
        $this->session->set_flashdata('msg', 'Cliente agregado correctamente');
      }
      
      redirect('admin/customers');

    }

    $data['subview'] = 'admin/customers/edit';
    $this->load->view('admin/_main_layout', $data);
  }

  public function ajax_getProvinces($dp_id)
  {
    echo $this->customers_m->get_provinces($dp_id);
  }

  public function ajax_getDistricts($pr_id)
  {
    echo $this->customers_m->get_districts($pr_id);
  }

}

/* End of file Customers.php */
/* Location: ./application/controllers/admin/Customers.php */