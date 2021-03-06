<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('PaymentModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{	
	//	$this->authent->checkLogin();

		$data['values'] = $this->PaymentModel->getAllData();
		$data['title'] = "Payment List";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('payment-list', $data, true);
		$this->load->view('templates/main', $data);
	}
	

/*	public function verify() 
	{
		$res = $this->UserModel->verifyLogin($this->input->post('username'), $this->input->post('password'));
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
	}*/

	public function delete($id)
	{
		$del = $this->PaymentModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/payments');

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

		// $res = $this->PositionModel->isPositionTaken($this->input->post('position_name'));
		// if ($res == NULL) {
		$data['payment_name'] = $this->input->post('payment_name');
		$data['payment_type'] = $this->input->post('payment_type');

		if(is_numeric($id))	 {
			
			$runQuery = $this->PaymentModel->updateData($data, $id);

					// if($runQuery){
					// 	$this->session->set_flashdata('success', 'Position has been added');
					// } else {
					// 	$this->session->set_flashdata('fail', 'Kesalahan penyimpanan terjadi.');
					// }
		} else {
		 	$runQuery = $this->PaymentModel->insertData($data);
			
		}

		redirect('/payments/');

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
