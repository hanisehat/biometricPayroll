<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentModel extends CI_Model
{
	public function getAllData()
	{
		$allData = $this->db->get('payments');
		return $allData->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('payments', $data);
		return $insert;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('payment_id', $id);
		$insert = $this->db->update('payments', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('payments', array('payment_id' => $id));
		return $delete;
	}


	public function getDataWhere($id)
	{
		$value = $this->db->get_where('payments', array('payment_id' => $id));
		return $value;
	}

	public function isPositionTaken($payment_type)
	{
		$query = $this->db->where('payment_type', $payment_type)->limit(1)->get('payments');
		
		if ( $query != NULL ) {
			return $query->row();
		}
	}

	public function verifyLogin($username, $password) 
	{
		$query = $this->db->where('username', $username)->where('password', sha1($password))->where('status', '1')->limit(1)->get('positions');
		$numrows = $query->num_rows();
		if ( $numrows > 0 ) {
			return $query->row();
		} else {
			$query = NULL;
		}
		
		
	}

}