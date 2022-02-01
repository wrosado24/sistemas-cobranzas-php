<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_m extends CI_Model {

  public function get_reportLoan($coin_id)
  {
    $this->db->select('c.short_name, sum(l.credit_amount) as sum_credit');
    $this->db->join('coins c', 'c.id = l.coin_id', 'left');
    $this->db->where('l.coin_id', $coin_id);
    $cr = $this->db->get('loans l')->row();

    $this->db->select('c.short_name, sum(TRUNCATE(l.credit_amount*(l.interest_amount/100) + l.credit_amount,2)) AS cr_interest');
    $this->db->join('coins c', 'c.id = l.coin_id', 'left');
    $this->db->where('l.coin_id', $coin_id);
    $cr_interest = $this->db->get('loans l')->row();

    $this->db->select('c.short_name, sum(TRUNCATE(l.credit_amount*(l.interest_amount/100) + l.credit_amount,2)) AS cr_interestPaid');
    $this->db->join('coins c', 'c.id = l.coin_id', 'left');
    $this->db->where(['l.coin_id' => $coin_id, 'l.status' => 0]);
    $cr_interestPaid = $this->db->get('loans l')->row();

    $this->db->select('c.short_name, sum(TRUNCATE(l.credit_amount*(l.interest_amount/100) + l.credit_amount,2)) AS cr_interestPay');
    $this->db->join('coins c', 'c.id = l.coin_id', 'left');
    $this->db->where(['l.coin_id' => $coin_id, 'l.status' => 1]);
    $cr_interestPay = $this->db->get('loans l')->row();

    $credits = [$cr, $cr_interest, $cr_interestPaid, $cr_interestPay];

    return $credits;
  }

  public function get_reportCoin($coin_id)
  {
    $this->db->where('id', $coin_id);

    return $this->db->get('coins')->row(); 
  }

  public function get_reportDates($coin_id, $start_date, $end_date)
  {
    $this->db->select("id, date, credit_amount, interest_amount, num_fee, payment_m,
     (num_fee*fee_amount) AS total_int, status");
    $this->db->from('loans');
    $this->db->where('coin_id', $coin_id);
    $this->db->where("date BETWEEN '{$start_date}' AND '{$end_date}'");

    return $this->db->get()->result(); 
  }

  public function get_reportCsts()
  {
    $this->db->select("id, dni, CONCAT(first_name, ' ',last_name) AS customer");
    $this->db->from('customers');
    $this->db->where('loan_status', 1);

    return $this->db->get()->result(); 
  }

  public function get_reportLC($customer_id)
  {
    $this->db->select("l.*, CONCAT(c.first_name, ' ', c.last_name) AS customer_name, co.short_name, co.name");
    $this->db->from('loans l');
    $this->db->join('customers c', 'c.id = l.customer_id', 'left');
    $this->db->join('coins co', 'co.id = l.coin_id', 'left');
    $this->db->where('l.customer_id', $customer_id);

    return $this->db->get()->result(); 
  }

  public function get_reportLI($loan_id)
  {
    $this->db->where('loan_id', $loan_id);

    return $this->db->get('loan_items')->result(); 
  }

}

/* End of file Reports_m.php */
/* Location: ./application/models/Reports_m.php */