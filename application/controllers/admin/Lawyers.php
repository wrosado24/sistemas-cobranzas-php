<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lawyers extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('lawyers_m');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->session->userdata('loggedin') == TRUE || redirect('user/login');
  }

  public function index()
  {
    $data['lawyers'] = $this->lawyers_m->get();
    $data['subview'] = 'admin/lawyers/index';
    $this->load->view('admin/_main_layout', $data);
  }

  public function edit($id = NULL)
  {
    if ($id) {
      $data['lawyer'] = $this->lawyers_m->get($id);
      $data['provinces'] = $this->lawyers_m->get_editProvinces($data['lawyer']->department_id);
      $data['districts'] = $this->lawyers_m->get_editDistricts($data['lawyer']->province_id);
    } else {
      $data['lawyer'] = $this->lawyers_m->get_new();
    }

    $data['departments'] = $this->lawyers_m->get_departments();

    $rules = $this->lawyers_m->lawyer_rules;
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {
      
      $cst_data = $this->lawyers_m->array_from_post(['ci','nombres', 'apellidos', 'genero', 'department_id', 'province_id', 'district_id', 'direccion', 'celular']);
      
      $this->lawyers_m->save($cst_data, $id);

      if ($id) {
        $this->session->set_flashdata('msg', 'Abogado actualizado correctamente');
      } else {
        $this->session->set_flashdata('msg', 'Abogado agregado correctamente');
      }
      
      redirect('admin/lawyers');

    }

    $data['subview'] = 'admin/lawyers/edit';
    $this->load->view('admin/_main_layout', $data);
  }

  public function ajax_getProvinces($dp_id)
  {
    echo $this->lawyers_m->get_provinces($dp_id);
  }

  public function ajax_getDistricts($pr_id)
  {
    echo $this->lawyers_m->get_districts($pr_id);
  }


}