<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('UserModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();
		
		$data['title'] = "User List";
		$data['joined_values'] = $this->UserModel->getAllData();

		$data['title'] = "User List";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('user-list', $data, true);
		$this->load->view('templates/main', $data);
	}
	
	public function login()
	{
		if(isset($_SESSION['username'])) {
			redirect('/');
		}

		$data['title'] = "Login";
		$this->load->view('login', $data);
	}

	public function logout()
	{
		session_destroy();
		redirect('/users/login');
	}

	public function profile($id)
	{
		$this->authent->checkLogin();

		$data['value'] = $this->UserModel->getDataWhere($id)->row();
		$data['title'] = "Profile";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('user-form', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function verify() 
	{
		//var_dump($_POST); die();
		$res = $this->UserModel->verifyLogin($this->input->post('username'), $this->input->post('password'));
		if ($res !== NULL ) {
			
			$_SESSION['username'] = $this->input->post('username');
			$_SESSION['role'] = $res->role;
			$_SESSION['user_id'] = $res->user_id;
			
			redirect('/');
		}
		 else {
		 	$this->session->set_flashdata('fail', 'Wrong username / password !');
			redirect('/users/login/');
		}
	}
	
	public function update_password()
	{	
		$data['password'] = sha1($this->input->post('password'));
		$id = $this->input->post('id');
		
		$command = $this->UserModel->updateData($data, $id);

		redirect('/users/new_user/'.$id);
	}

	public function new_user($id='')
	{
		$this->authent->checkLogin();
		
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
		$del = $this->UserModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/users');

	}
	
	public function update_user($id='')
	{	
    
		$id = $this->input->post('id');

		
		$data['username'] = $this->input->post('username');
		$data['name'] = $this->input->post('name');
		$data['email'] = $this->input->post('email');
		/*$data['password'] = $this->input->post('password');*/
		$data['role'] = $this->input->post('role');
		$data['status'] = $this->input->post('status');
		
		//if($this->)

		if( is_numeric($id) ) {
			
			$message = 'update';
			$command = $this->UserModel->updateData($data, $id);
		} 
		else {

			$message = 'insert';
			$command = $this->UserModel->insertData($data);
		}

		if($message == 'insert') {
			//echo json_encode($message);
			redirect('/users');
		} else {
			redirect('/users');
		}

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

		$checkOtherUsername = $this->UserModel->checkOtherUsername($this->input->post('username'), $id);

		if ($checkOtherUsername->row() == NULL) {
			$query = $this->UserModel->updateData($data, $id);
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

		$res = $this->UserModel->isUsernameTaken($this->input->post('username'));
		if ($res == NULL) {
			
			$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'password' => sha1($this->input->post('password')),
					'username' => $this->input->post('username'),
					'role' => $this->input->post('role'),
					'status' => $this->input->post('status'),
				);

					$runQuery = $this->UserModel->insertData($data);

					if($runQuery){
						$this->session->set_flashdata('success', 'User berhasil ditambahkan');
					} else {
						$this->session->set_flashdata('fail', 'Kesalahan penyimpanan terjadi.');
					}
		} else {
		 	$this->session->set_flashdata('usernameTaken', 'Username already taken!');
			redirect('/users/register/');
		}

	}

	public function getData()
	{
		$result = array();
	    $query = $this->UserModel->getAllData()->result_array();
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
		$query = $this->UserModel->getDataWhere($id)->row();
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
		return $this->load->view('templates/header', $data, true);
	}

	public function footer()
	{
		$data = array();
		return $this->load->view('templates/footer', $data, true);
	}
}
