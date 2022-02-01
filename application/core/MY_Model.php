<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

  protected $_table_name = '';
  protected $_primary_key = 'id';

  public function get($id = NULL, $single=FALSE)
  {
    if ($id != NULL) {
      $this->db->where($this->_primary_key, $id);
      $method = 'row';
    } else if($single == TRUE) {
      $method = 'row';
    } else{
      $method = 'result';
    }
    
    $this->db->order_by("id", "desc");
    
    return $this->db->get($this->_table_name)->$method();
  }

  public function get_by($where, $single = FALSE)
  {
    $this->db->where($where);

    return $this->get(NULL, $single);
  }

  public function save($data, $id = NULL)
  {
    // Insert
    if ($id === NULL) {
      $this->db->insert($this->_table_name, $data);
      $id = $this->db->insert_id();
    } 
    // Update
    else {
      $this->db->where($this->_primary_key, $id);
      $this->db->update($this->_table_name, $data);     
    }

    return $id;
  }

  public function delete($id)
  {
    if (!$id) {
      return FALSE;
    }

    $this->db->where($this->_primary_key, $id);
    $this->db->delete($this->_table_name);
  }

  public function array_from_post($fields)
  {
    $data = [];
    foreach($fields as $value){
      $data[$value] = $this->input->post($value);
    }
    return $data;
  }

  public function hash($string)
  {
    return hash('sha512', $string . config_item('encryption_key'));
  }

}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */