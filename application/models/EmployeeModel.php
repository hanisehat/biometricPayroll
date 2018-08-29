<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{
	public function getAllData()
	{
		$this->db->select('*');
		$this->db->from('employees e');
		$this->db->join('positions p', 'e.employee_position = p.position_id');

		$allData = $this->db->get();
		return $allData;
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('employees', $data);
		return $insert;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('employee_id', $id);
		$insert = $this->db->update('employees', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('employees', array('employee_id' => $id));
		return $delete;
	}

	public function checkOtherUsername($username, $id)
	{
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where('employee_id !=', $id);
		$this->db->where('username', $username);
		$check =$this->db->get();
		return $check;
	}

	public function getDataWhere($id)
	{
		$value = $this->db->get_where('employees', array('employee_id' => $id));
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
		$query = $this->db->where('username', $username)->where('password', sha1($password))->where('status', '1')->limit(1)->get('employees');
		$numrows = $query->num_rows();
		if ( $numrows > 0 ) {
			return $query->row();
		} else {
			$query = NULL;
		}
		
		
	}

}