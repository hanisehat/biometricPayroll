<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AllowanceModel extends CI_Model
{

	public function getAllData()
	{
		$allData = $this->db->get('allowances');
		return $allData->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('allowances', $data);
		return $insert;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('allowance_id', $id);
		$insert = $this->db->update('allowances', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('allowances', array('allowance_id' => $id));
		return $delete;
	}

	public function checkOtherUsername($username, $id)
	{
		$this->db->select('*');
		$this->db->from('allowances');
		$this->db->where('allowance_id !=', $id);
		$this->db->where('username', $username);
		$check =$this->db->get();
		return $check;
	}

	public function getDataWhere($id)
	{
		$value = $this->db->get_where('allowances', array('allowance_id' => $id));
		return $value;
	}

	public function isAllowanceTaken($allowance_name)
	{
		$query = $this->db->where('allowance_name', $allowance_name)->limit(1)->get('allowances');
		
		if ( $query != NULL ) {
			return $query->row();
		}
	}
}