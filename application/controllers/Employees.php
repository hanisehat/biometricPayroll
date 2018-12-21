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
		$this->authent->checkLogin();

		$data['title'] = "Employee List";
		$data['joined_values'] = $this->EmployeeModel->getAllData();
		$data['positions'] = $this->PositionModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('employee-list', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function profile($id)
	{
		$this->authent->checkLogin();

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
		$res = $this->EmployeeModel->verifyLogin($this->input->post('username'), $this->input->post('password'));
		if ($res !== NULL ) {
			
			$_SESSION['username'] = $this->input->post('username');
			$_SESSION['name'] = $res->employee_name;
			$_SESSION['position'] = $res->position_name;
			$_SESSION['priority'] = $res->position_priority;
			$_SESSION['user_id'] = $res->employee_id;
			
			redirect('/dashboard_emp');
		}
		 else {
		 	session_start();
		 	$this->session->set_flashdata('fail', 'Wrong username / password !');
			redirect('/users/login/');
		}
	}

	public function employee_form($id='')
	{
		$this->authent->checkLogin();


		// echo "string";
		if ($id != '') {
			$data['value'] = $this->EmployeeModel->getDataWhere($id)->row();
			$data['title'] = "Edit Employee";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Employee";

		}
		
		$data['positions'] = $this->PositionModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('employee-form', $data, true);
		$this->load->view('templates/main', $data);
	}
	
	public function employee_login()
	{
		if(isset($_SESSION['username'])) {
			redirect('/');
		}

		$data['title'] = "Login Employee";
		$this->load->view('employee-login', $data);
	}
	
	public function employee_detail($id=''){
		$data['value'] = $this->EmployeeModel->getDataWhere($id)->row();
		$data['title'] = "Detail Employee";
		
		$data['positions'] = $this->PositionModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('employee-detail', $data, true);
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

		redirect('/employees');
	}

	
	public function activation($status, $id)
	{	
		$data['employee_status'] = $status;
		$activation = $this->EmployeeModel->updateData($data, $id);
		if( $activation ) {
			$this->session->set_flashdata('success', 'Data user berhasil diupdate');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penyimpanan terjadi.');
		}

		redirect('/employees');
	}
	
	public function update_password()
	{	
		$data['employee_password'] = sha1($this->input->post('password'));
		$id = $this->input->post('id');
		
		$command = $this->EmployeeModel->updateData($data, $id);

		redirect('/employees/employee_form/'.$id);
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
		$data['employee_username'] = $this->input->post('emp_username');
		$data['employee_position'] = $this->input->post('emp_position');
		$data['employee_salary'] = $this->input->post('emp_salary');
		$data['employee_status'] = $this->input->post('emp_status');
		$data['employee_phone'] = $this->input->post('emp_phone');
		$data['employee_gender'] = $this->input->post('emp_gender');
		$data['employee_duration'] = $this->input->post('emp_duration');
		$data['employee_address'] = $this->input->post('emp_address');
		$data['employee_birth'] = $this->input->post('birth_date');
		$data['employee_start'] = $this->input->post('start_date');
		
		//if($this->)

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
				$this->upload->do_upload('emp_certificate');
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
			redirect('/employees');
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
		return $this->load->view('templates/header_admin', $data, true);
	}

	public function footer()
	{
		$data = array();
		return $this->load->view('templates/footer', $data, true);
	}
}
?>