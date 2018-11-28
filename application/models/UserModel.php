<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{
	public function getAllData()
	{
		$allData = $this->db->get('users');
		return $allData->result();
	}

	public function insertData($data)
	{
		$insert = $this->db->insert('users', $data);
		return $insert;
	}

	public function updateData($data, $id)
	{
    	$this->db->where('user_id', $id);
		$insert = $this->db->update('users', $data);
		return $insert;
	}

	public function deleteData($id)
	{
		$delete = $this->db->delete('users', array('user_id' => $id));
		return $delete;
	}

	public function checkOtherUsername($username, $id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id !=', $id);
		$this->db->where('username', $username);
		$check =$this->db->get();
		return $check;
	}

	public function getDataWhere($id)
	{
		$value = $this->db->get_where('users', array('user_id' => $id));
		return $value;
	}

	public function isUsernameTaken($username)
	{
		$query = $this->db->where('username', $username)->limit(1)->get('users');
		
		if ( $query != NULL ) {
			return $query->row();
		}
	}

	public function verifyLogin($username, $password) 
	{
		$query = $this->db->where('username', $username)->where('password', sha1($password))->where('status', '1')->limit(1)->get('users');
		$numrows = $query->num_rows();
		if ( $numrows > 0 ) {
			return $query->row();
		} else {
			$query = NULL;
		}
		
		
	}

}