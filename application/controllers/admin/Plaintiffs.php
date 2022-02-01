<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plaintiffs extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('plaintiffs_m');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['plaintiffs'] = $this->plaintiffs_m->get();
    $data['subview'] = 'admin/plaintiffs/index';
    $this->load->view('admin/_main_layout', $data);
  }

  public function edit($id = NULL)
  {
    if ($id) {
      $data['plaintiff'] = $this->plaintiffs_m->get($id);
      $data['provinces'] = $this->plaintiffs_m->get_editProvinces($data['plaintiff']->department_id);
      $data['districts'] = $this->plaintiffs_m->get_editDistricts($data['plaintiff']->province_id);
    } else {
      $data['plaintiff'] = $this->plaintiffs_m->get_new();
    }

    $data['departments'] = $this->plaintiffs_m->get_departments();

    $rules = $this->plaintiffs_m->plaintiff_rules;
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {
      
      $cst_data = $this->plaintiffs_m->array_from_post(['ci','nombres', 'apellidos', 'genero', 'department_id', 'province_id', 'district_id', 'direccion', 'celular']);
      
      $this->plaintiffs_m->save($cst_data, $id);

      if ($id) {
        $this->session->set_flashdata('msg', 'Demandante actualizado correctamente');
      } else {
        $this->session->set_flashdata('msg', 'Demandante agregado correctamente');
      }
      
      redirect('admin/plaintiffs');

    }

    $data['subview'] = 'admin/plaintiffs/edit';
    $this->load->view('admin/_main_layout', $data);
  }

  public function ajax_getProvinces($dp_id)
  {
    echo $this->plaintiffs_m->get_provinces($dp_id);
  }

  public function ajax_getDistricts($pr_id)
  {
    echo $this->plaintiffs_m->get_districts($pr_id);
  }


}