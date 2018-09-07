<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PositionModel extends CI_Model
{
	public function getAllData()
	{
		$allData = $this->db->get('positions');
		return $allData->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('positions', $data);
		return $insert;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('position_id', $id);
		$insert = $this->db->update('positions', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('positions', array('position_id' => $id));
		return $delete;
	}

	public function checkOtherUsername($username, $id)
	{
		$this->db->select('*');
		$this->db->from('positions');
		$this->db->where('position_id !=', $id);
		$this->db->where('username', $username);
		$check =$this->db->get();
		return $check;
	}

	public function getDataWhere($id)
	{
		$value = $this->db->get_where('positions', array('position_id' => $id));
		return $value;
	}

	public function isPositionTaken($position_name)
	{
		$query = $this->db->where('position_name', $position_name)->limit(1)->get('positions');
		
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