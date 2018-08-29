<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();
		
		$this->load->model('EmployeeModel');
		$this->load->model('PositionModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$data['title'] = "Employee List";
		$data['joined_values'] = $this->EmployeeModel->getAllData()->result();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('employee-list', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function profile($id)
	{
		$data['value'] = $this->EmployeeModel->getDataWhere($id)->row();
		$data['title'] = "Employee Profile";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('employee', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function verify() 
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
	}

	public function new_employee($id='')
	{
		if ($id != '') {
			$data['value'] = $this->EmployeeModel->getDataWhere($id)->row();
			$data['title'] = "Edit Employee";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Employee";

		}
		
		$data['positions'] = $this->PositionModel->getAllData()->result();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('employee-form', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function delete($id)
	{
		$del = $this->EmployeeModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/users');

	}

	public function update_employee($id='')
	{	
		$config['upload_path']          = './files/employee_pictures';
        $config['allowed_types']        = 'jpg|jpeg|png|PNG|JPG|JPEG';
        $config['max_size']             = 5000;
        $config['encrypt_name']         = true;

        $this->load->library('upload', $config);
    
		$id = $this->input->post('id');

		$emp_picture = $_FILES["emp_picture"]["name"];
		$emp_idcard = $_FILES["emp_idcard"]["name"];
		$emp_certificate = $_FILES["emp_certificate"]["name"];

		$data['employee_name'] = $this->input->post('emp_name');
		$data['employee_position'] = $this->input->post('emp_position');
		$data['employee_salary'] = $this->input->post('emp_salary');
		$data['employee_status'] = $this->input->post('emp_status');
		$data['employee_phone'] = $this->input->post('emp_phone');
		$data['employee_address'] = $this->input->post('emp_address');

		if( is_numeric($id) ) {
			
			if (!empty($emp_picture)) {
				$this->upload->do_upload('emp_picture');
    			$image_upload = $this->upload->data();

    			$data['employee_picture'] = 'files/employee_pictures/'.$this->upload->file_name;
			}
			if (!empty($emp_idcard)) {
				$this->upload->do_upload('emp_idcard');
    			$image_upload = $this->upload->data();

    			$data['employee_idcard'] = 'files/employee_pictures/'.$this->upload->file_name;
			}
			if (!empty($emp_certificate)) {
				$this->upload->do_upload('emp_cwertificate');
    			$image_upload = $this->upload->data();

    			$data['employee_certificate'] = 'files/employee_pictures/'.$this->upload->file_name;
			}
			$message = 'update';
			$command = $this->EmployeeModel->updateData($data, $id);
		} 
		else {
			 	if (!empty($emp_picture)) {
					$this->upload->do_upload('emp_picture');
	    			$image_upload = $this->upload->data();

	    			$data['employee_picture'] = 'files/employee_pictures/'.$this->upload->file_name;
				}
			 	if (!empty($emp_idcard)) {
					$this->upload->do_upload('emp_idcard');
	    			$image_upload = $this->upload->data();

	    			$data['employee_idcard'] = 'files/employee_pictures/'.$this->upload->file_name;
				}
			 	if (!empty($emp_certificate)) {
					$this->upload->do_upload('emp_certificate');
	    			$image_upload = $this->upload->data();

	    			$data['employee_certificate'] = 'files/employee_pictures/'.$this->upload->file_name;
				}

				$message = 'insert';
			
			$command = $this->EmployeeModel->insertData($data);
		}

		if($message == 'insert') {
			//echo json_encode($message);
			redirect('/employees');
		} else {
			redirect('/employees/new_employee/'.$id);
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
