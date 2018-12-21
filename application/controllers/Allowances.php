<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allowances extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();
		
		$this->authent->checkLogin();
		$this->load->model('AllowanceModel');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$data['title'] = "Allowance List";
		$data['values'] = $this->AllowanceModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('allowance-list', $data, true);
		$this->load->view('templates/main', $data);
	}
	
	public function new_claim()
	{
		//$data['value'] = $this->AllowanceModel->getDataWhere($id)->row();
		$data['title'] = "New Allowance";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('claim-form', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function verify() 
	{
		$res = $this->AllowanceModel->verifyLogin($this->input->post('username'), $this->input->post('password'));
		if ($res !== NULL ) {
			
			$_SESSION['username'] = $this->input->post('username');
			$_SESSION['role'] = $res->role;
			$_SESSION['user_id'] = $res->user_id;
			if($res->role < 2 )
			{
				$_SESSION['avatar'] = "<img src='".base_url()."assets/images/boss.png' alt='Profile Image' />";

			} else {
				$_SESSION['avatar'] = "<img src='".base_url()."assets/images/admin.png' alt='Profile Image' />";
			}
			
			redirect('/');
		}
		 else {
		 	$this->session->set_flashdata('fail', 'Wrong username / password !');
			redirect('/users/login/');
		}
	}

	public function register($id='')
	{
		if ($id != '') {
			$data['value'] = $this->UserModel->getDataWhere($id)->row();
			$data['title'] = "Edit User";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New User";

		}

		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('user-form', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function delete($id)
	{
		$del = $this->AllowanceModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/users');

	}

	public function update($id)
	{	
		$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'role' => $this->input->post('role'),
					'status' => $this->input->post('status'),
				);

		if($this->input->post('password') != ''){
			$data['password'] = sha1($this->input->post('password'));
		
		}

		$checkOtherUsername = $this->AllowanceModel->checkOtherUsername($this->input->post('username'), $id);

		if ($checkOtherUsername->row() == NULL) {
			$query = $this->AllowanceModel->updateData($data, $id);
			if($query){
				$this->session->set_flashdata('success', 'Update Profile Success!');
				redirect('/users/profile/'.$id);

			} else {
				$this->session->set_flashdata('usernameTaken', 'Kesalahan penyimpanan terjadi!');
				redirect('/users/profile/'.$id);

			}

		} else {

			$this->session->set_flashdata('usernameTaken', 'Username already taken!');
			redirect('/users/profile/'.$id);
		}	
			

	}

	public function view($id)
	{
		$data['title'] = "haha";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('user-detail', array(), true);
		$this->load->view('templates/main', $data);
	}

	public function add()
	{
	
		$id = $this->input->post('id');
		$data = array(
					'allowance_name' => $this->input->post('allowance_name'),
				);

		$res = $this->AllowanceModel->isAllowanceTaken($this->input->post('allowance_name'));
		if ($res == NULL) {
			
			if(is_numeric($id))	 {
			
				$runQuery = $this->AllowanceModel->updateData($data, $id);
			} else {
				$runQuery = $this->AllowanceModel->insertData($data);
			}
			
			if($runQuery){
				$this->session->set_flashdata('success', 'User berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('fail', 'Kesalahan penyimpanan terjadi.');
			}
			
		} else {
		 	$this->session->set_flashdata('usernameTaken', 'Allowance already exist!');
		}

		redirect('/allowances/');

	}

	public function getData()
	{
		$result = array();
	    $query = $this->AllowanceModel->getAllData()->result_array();
			 $i = 1;
    	 foreach ($query as $row) {

    	 	if ($row['status'] == 0){
    	 		$row['status'] = 'Tidak Aktif';
    	 	} else {
    	 		$row['status'] = 'Aktif';
    	 	}

    	 	if ($row['role'] == 1){
    	 		$row['role'] = 'Super User';
    	 	} else if ($row['role'] == 2){
    	 		$row['role'] = 'Admin';
    	 	} else {
    	 		$row['role'] = 'User';
    	 	}

	        $result[] = array(
	         					"no" => $i++,
	         					"recid" => $row['user_id'],
	         					"name" => $row['name'],
	         					"username" => $row['username'],
	         					"email" => $row['email'],
	         					"role" => $row['role'],
	         					"status" => $row['status']
	         				);
	     }

	     $root['records'] = $result;

	   //  var_dump(json_encode($root));
    	return print json_encode($root);
	}

	public function getRole()
	{
		$result = array();
	    $query = $this->RoleModel->getAllData()->result_array();
		$i = 1;

		foreach ($query as $row) {
		    $result[] = array(
	     					"no" => $i++,
	     					"recid" => $row['role_id'],
	     					"name" => $row['name'],
	     					"display_name" => $row['display_name'],
	     					"access_lvl" => $row['access_lvl'],
	     					"object_lvl" => $row['object_lvl'],
	     				);
		}
	     $root['records'] = $result;

	   //  var_dump(json_encode($root));
    	return print json_encode($root);
	}

	public function getDataEdit($id) 
	{
		$query = $this->AllowanceModel->getDataWhere($id)->row();
		return print json_encode($query);
	}

	public function sidebar()
	{
		$data = array();
		return $this->load->view('templates/sidebar', $data, true);
	}

	public function header()
	{
		$data = array();
		return $this->load->view('templates/header_admin', $data, true);
	}

	public function footer()
	{
		$data = array();
		return $this->load->view('templates/footer', $data, true);
	}
}
