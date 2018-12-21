<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salaries_part extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('PartSalaryModel');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{	
		$this->authent->checkLogin();

		$data['title'] = "Salary List";
		$data['values'] = $this->PartSalaryModel->getAllData();
		$data['employees'] = $this->EmployeeModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('part-salary-list', $data, true);
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

	public function delete($id)
	{
		$del = $this->PartSalaryModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/salaries_part');

	}
	
	
	public function get_detail($id)
	{
		$data = $this->PartSalaryModel->getDataWhere($id);
		echo json_encode($data);
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

		$data['salary_name'] = $this->input->post('salary_name');
		//$data['salary_duration'] = $this->input->post('salary_duration');
		//$data['salary_amount'] = $this->input->post('salary_amount');

		if(is_numeric($id))	 {
			
			$runQuery = $this->PartSalaryModel->updateData($data, $id);

					// if($runQuery){
					// 	$this->session->set_flashdata('success', 'Position has been added');
					// } else {
					// 	$this->session->set_flashdata('fail', 'Kesalahan penyimpanan terjadi.');
					// }
		} else {
		 	$runQuery = $this->PartSalaryModel->insertData($data);
			
		}

		redirect('/salaries_part/');

	}
	
	public function update()
	{
	
		$id = $this->input->post('id');

		$data['employee_name'] = $this->input->post('employee_name');
		$data['employee_salary'] = $this->input->post('employee_salary');

		if(is_numeric($id))	 {
			
			$runQuery = $this->PartSalaryModel->updateData($data, $id);

					// if($runQuery){
					// 	$this->session->set_flashdata('success', 'Position has been added');
					// } else {
					// 	$this->session->set_flashdata('fail', 'Kesalahan penyimpanan terjadi.');
					// }
		} else {
		 	$runQuery = $this->PartSalaryModel->insertData_($data);
			
		}

		redirect('/salaries_part/');

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
