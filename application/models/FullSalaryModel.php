<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FullSalaryModel extends CI_Model
{
	public function getAllData()
	{
		
		$this->db->select('*');
		$this->db->from('salaries_full');
		$this->db->join('employees', 'salaries_full.salary_name = employees.employee_id');
		$query = $this->db->get();
		
		return $query->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('salaries_full', $data);
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
		$delete = $this->db->delete('salaries_full', array('salary_id' => $id));
		return $delete;
	}

	public function checkOtherUsername($name, $id)
	{
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where('empployees_id !=', $id);
		$this->db->where('name', $name);
		$check =$this->db->get();
		return $check;
	}

	public function getDataWhere($id)
	{
		$value = $this->db->get_where('salaries_full', array('salary_id' => $id));
		return $value;
	}


}