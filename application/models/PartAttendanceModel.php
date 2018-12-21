<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartAttendanceModel extends CI_Model
{
	public function getAllData()
	{
		$this->db->select('*');
		$this->db->from('attendances_part');
		$this->db->join('employees', 'attendances_part.attendance_employee = employees.employee_id');
		$query = $this->db->get();
		
		return $query->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('attendances_part', $data);
		return $insert;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('attendance_id', $id);
		$insert = $this->db->update('attendances_part', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('attendances_part', array('attendance_id' => $id));
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
		$value = $this->db->get_where('attendances_part', array('attendance_id' => $id));
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