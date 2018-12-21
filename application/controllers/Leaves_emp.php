<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves_emp extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('LeaveModel_emp');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();

		$data['title'] = "Leave List";
		$data['joined_values'] = $this->LeaveModel_emp->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('leave-list-emp', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function get_detail($id)
	{
		$data = $this->LeaveModel_emp->getDataWhere($id);
		echo json_encode($data);
	}

	public function delete($id)
	{
		$del = $this->LeaveModel_emp->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/leaves_emp');
	}
	
	public function leave_form($id='')
	{
		$this->authent->checkLogin();

		// echo "string";
		if ($id != '') {
			$data['value'] = $this->EmployeeModel->getDataWhere($id)->row();
			$data['title'] = "Add New Leave Request";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Leave Request";

		}
		
		$data['positions'] = $this->LeaveModel_emp->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('leave-form-emp', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function leave_approval()
	{	

		$data['leave_reply_message'] = $this->input->post('rejection_reason');
		$data['leave_status'] = $this->input->post('leave_status');
		$id = $this->input->post('id');
		//var_dump($id); die();
		$query = $this->LeaveModel_emp->updateData($data, $id);

		if($query) {
			redirect('/leaves_emp');	
		}
		
	}

	// public function leave_new($id='')
	// {	
		// $id = $this->input->post('id');
		
		// $leave_status = $_FILES["leave_status"]["name"];

		// $data['leave_message'] = $this->input->post('leave_message');
		// $data['leave_date_start'] = $this->input->post('leave_date_start');
		// $data['leave_date_end'] = $this->input->post('leave_date_end');
		// $data['leave_employee'] = $this->input->post('employee_id');
		//$data['leave_status'] = '2'; // 0=rejected, 1= approved, 2 = waiting approval
		//var_dump($data); die();
		
		// if( is_numeric($id) ) {
			
			// if (!empty($leave_status)){
				// $data['leave_status'] = '2';
			// }
			
			// $message = 'update';
			// $command = $this->LeaveModel_emp->updateData($data, $id);
		// } 
		// else {
			// if (!empty($leave_status)){
				// $data['leave_status'] = '2';
			// }

			// $message = 'insert';
			// $command = $this->LeaveModel_emp->insertData($data);
		// }

		// if($message == 'insert') {
			//echo json_encode($message);
			// redirect('/leaves_emp');
		// } else {
			// redirect('/leaves_emp');
		// }
	// }
	
	public function leave_new()
	{	

		$data['leave_message'] = $this->input->post('leave_message');
		$data['leave_date_start'] = $this->input->post('leave_date_start');
		$data['leave_date_end'] = $this->input->post('leave_date_end');
		$data['leave_employee'] = $this->input->post('employee_id');
		$data['leave_status'] = '2'; // 0=rejected, 1= approved, 2 = waiting approval
		//var_dump($data); die();
		$query = $this->LeaveModel_emp->insertData($data);

		if($query) {
			redirect('/leaves_emp');	
		}
		
	}
	
	public function leave_update()
	{	
		$id = $this->input->post('id');

		$data['leave_message'] = $this->input->post('leave_message');
		$data['leave_date_start'] = $this->input->post('leave_date_start');
		$data['leave_date_end'] = $this->input->post('leave_date_end');
		$data['leave_employee'] = $this->input->post('employee_id');
		$data['leave_status'] = '2'; // 0=rejected, 1= approved, 2 = waiting approval
		//var_dump($data); die();
		
		if(is_numeric($id))	 {
		$query = $this->LeaveModel_emp->updateData($data, $id);
		}

			redirect('/leaves_emp');	
		
	}

	public function sidebar()
	{
		$data = array();
		return $this->load->view('templates/sidebar_emp', $data, true);
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
