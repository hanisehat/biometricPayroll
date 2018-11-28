<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportModel extends CI_Model
{

	public function getAllData()
	{
		//if position doesn't exist, data won't show
		$this->db->select('*');
		$this->db->from('reports');
		$this->db->join('employees', 'reports.report_employee = employees.employee_id');
		$query = $this->db->get();

		return $query->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('reports', $data);
		return $insert;
	}

	public function getDataWhere($id)
	{
		$this->db->select('*');
		$this->db->from('reports');
		$this->db->where('report_id', $id);
		$this->db->join('employees', 'reports.report_employee = employees.employee_id');
		$value =$this->db->get()->row();
		return $value;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('report_id', $id);
		$insert = $this->db->update('reports', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('reports', array('report_id' => $id));
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