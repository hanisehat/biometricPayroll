<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClaimModel extends CI_Model
{

public function getAllData()
	{
		$allData = $this->db->get('claims');
		return $allData->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('claims', $data);
		return $insert;
	}

	public function updateData($id, $data)
	{
    	$this->db->where('claim_id', $id);
		$insert = $this->db->update('claims', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('claims', array('claim_id' => $id));
		return $delete;
	}

	public function getDataWhere($id)
	{
		$value = $this->db->get_where('claims', array('claim_id' => $id));
		return $value;
	}

	public function isUsernameTaken($username)
	{
		$query = $this->db->where('username', $username)->limit(1)->get('employees');
		
		if ( $query != NULL ) {
			return $query->row();
		}
	}

	public function verifyLogin($username, $password) 
	{	
		$this->db->from('employees');
		$this->db->join('positions', 'employees.employee_position = positions.position_id');
		$query = $this->db->where('employee_username', $username)->where('employee_password', sha1($password))->where('employee_status', '1')->limit(1)->get();
		$numrows = $query->num_rows();
		if ( $numrows > 0 ) {
			return $query->row();
		} else {
			$query = NULL;
		}
		
		
	}

}