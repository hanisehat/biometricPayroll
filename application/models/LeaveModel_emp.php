<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeaveModel_emp extends CI_Model
{

	public function getAllData()
	{
		//if position doesn't exist, data won't show
		$this->db->select('*');
		$this->db->from('leaves');
		$this->db->join('employees', 'leaves.leave_employee = employees.employee_id');
		$this->db->join('positions', 'employees.employee_position = positions.position_id');
		$this->db->where('employee_name', $this->session->userdata('name'));
		
		$query = $this->db->get();

		return $query->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('leaves', $data);
		return $insert;
	}

	public function getDataWhere($id)
	{
		$this->db->select('*');
		$this->db->from('leaves');
		$this->db->where('leave_id', $id);
		$this->db->join('employees', 'leaves.leave_employee = employees.employee_id');
		$this->db->join('positions', 'employees.employee_position = positions.position_id');
		$value =$this->db->get()->row();
		return $value;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('leave_id', $id);
		$insert = $this->db->update('leaves', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('leaves', array('leave_id' => $id));
		return $delete;
	}

	public function checkOtherUsername($username, $id)
	{
		$this->db->select('*');
		$this->db->from('leaves');
		$this->db->where('employee_id !=', $id);
		$this->db->where('username', $username);
		$check =$this->db->get();
		return $check;
	}


}