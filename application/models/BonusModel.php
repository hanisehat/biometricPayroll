<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BonusModel extends CI_Model
{
	public function getAllData()
	{
		$this->db->select('*');
		$this->db->from('bonuses');
		$this->db->join('employees', 'bonuses.bonus_employee = employees.employee_id');
		$query = $this->db->get();
		
		return $query->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('bonuses', $data);
		return $insert;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('bonus_id', $id);
		$insert = $this->db->update('bonuses', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('bonuses', array('bonus_id' => $id));
		return $delete;
	}


	public function getDataWhere($id)
	{
		$value = $this->db->get_where('bonuses', array('bonus_id' => $id));
		return $value;
	}

	public function isPositionTaken($bonus_type)
	{
		$query = $this->db->where('bonus_type', $bonus_type)->limit(1)->get('bonuses');
		
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