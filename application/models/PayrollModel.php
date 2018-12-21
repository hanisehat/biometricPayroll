<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollModel extends CI_Model
{
	public function getAllData()
	{
		
		$this->db->select('*');
		$this->db->from('salaries');
		$this->db->join('employees', 'salaries.salary_name = employees.employee_id');
		$this->db->where('employee_name', $this->session->userdata('name'));
		
		$query = $this->db->get();
		
		return $query->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('salaries', $data);
		return $insert;
	}
	
	public function insertData_($data)
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
		$delete = $this->db->delete('salaries', array('salary_id' => $id));
		return $delete;
	}

	public function checkOtherUsername($name, $id)
	{
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where('employees_id !=', $id);
		$this->db->where('name', $name);
		$check =$this->db->get();
		return $check;
	}

	public function getDataWhere($id)
	{
		$value = $this->db->get_where('salaries', array('salary_id' => $id));
		return $value;
	}


}