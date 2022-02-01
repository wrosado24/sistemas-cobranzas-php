<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments_m extends CI_Model {

  protected $_table_name = 'loan_items';

  public function get_payments()
  {
    $this->db->select("li.id, c.dni, concat(c.first_name,' ',c.last_name) AS name_cst, l.id AS loan_id, li.pay_date, li.num_quota, li.fee_amount");
    $this->db->from('loan_items li');
    $this->db->join('loans l', 'l.id = li.loan_id', 'left');
    $this->db->join('customers c', 'c.id = l.customer_id', 'left');
    $this->db->where('li.status', 0);
    $this->db->order_by('li.pay_date', 'desc');

    return $this->db->get()->result(); 
  }

  public function get_searchCst($dni)
  {
    $this->db->select("l.id as loan_id, l.customer_id, c.dni, concat(c.first_name, ' ', c.last_name) AS cst_name, l.credit_amount, l.payment_m, co.name as coin_name");
    $this->db->from('customers c');
    $this->db->join('loans l', 'l.customer_id = c.id', 'left');
    $this->db->join('coins co', 'co.id = l.coin_id', 'left');
    $this->db->where(['c.loan_status' => 1, 'l.status' => 1, 'c.dni' => $dni]);
    //$this->db->where(['c.loan_status' => 1, 'c.dni' => $dni]);
   
    return $this->db->get()->row(); 
  }

  public function get_quotasCst($loan_id)
  { 
    $this->db->select("li.id, li.loan_id, li.date, li.num_quota, 
    (
    case 
      when (select SUM(abono) from loan_items_detail where loan_item_id  = li.id) = NULL then li.fee_amount
      when (select SUM(abono) from loan_items_detail where loan_item_id  = li.id) > 0 
      and (select SUM(abono) from loan_items_detail where loan_item_id  = li.id) < li.fee_amount  
      then li.fee_amount - (select SUM(abono) from loan_items_detail where loan_item_id  = li.id)
      else li.fee_amount 
    end
    ) as fee_amount, li.pay_date, li.status");
    $this->db->where('loan_id', $loan_id);

    $query = $this->db->get('loan_items li');
    $data = [];

    foreach ($query->result() as $row) {
      $data[] = [
        '<input type="checkbox" name="quota_id[]" '. ($row->status ? '' : 'disabled checked') . ' data-fee='.$row->fee_amount.' value='.$row->id.'>', 
        $row->num_quota, 
        $row->date, 
        round($row->fee_amount,2), 
        '<button type="button" class="btn btn-sm ' . ($row->status ? 'btn-outline-danger' : 'btn-outline-success') . '">'. ($row->status ? 'Pendiente': 'Pagado') .'</button>',
        ];
    }

    return $data;
  }

  public function check_cstLoan($loan_id)
  {
    $this->db->where('loan_id', $loan_id);

    $query = $this->db->get('loan_items'); 

    $check = false;

    foreach ($query->result() as $row) {
      if ($row->status == 1) {
        $check = true;
        break;
      } 
    }

    return $check;
  }

  public function update_cstLoan($loan_id, $customer_id)
  {
    $this->db->where('id', $loan_id);
    $this->db->update('loans', ['status' => 0]);

    $this->db->where('id', $customer_id);
    $this->db->update('customers', ['loan_status' => 0]); 
  }

  //funciones propias para el abono

  public function actualizar_cuota_sin_abono($data, $id)
  {
        $this->db->where('id', $id);
        $this->db->update('loan_items', $data); 
  }

  public function paga_cuota_con_abono($data, $id)
  {
        $this->db->where('id', $id);
        $this->db->update('loan_items', $data); 
  }

  public function obtener_cuotas_pago_sin_abono($data)
  {
    $this->db->where_in('id', $data);
    return $this->db->get('loan_items')->result();
  }

  public function obtener_cuotas_pago_con_abono($data)
  {
    $this->db->where_in('id', $data);
    return $this->db->get('loan_items_detail')->result();
  }

  public function obtenerValorDeCuotaPorId($loan_item_id)
  {
    $this->db->select('fee_amount');
    $this->db->where('id', $loan_item_id);
    return $this->db->get('loan_items')->result();
  }

  public function obtenerTotalAbono($loan_item_id)
  {
    $this->db->select('abono');
    $this->db->where('loan_item_id', $loan_item_id);
    return $this->db->get('loan_items_detail')->result();
  }

  function insertar_abonos($data)
	{
    $this->db->insert('loan_items_detail',$data);
    return true;
	}

}

/* End of file Payments_m.php */
/* Location: ./application/models/Payments_m.php */