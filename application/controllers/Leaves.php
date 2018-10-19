<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('LeaveModel');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();

		$data['title'] = "Leaves List";
		$data['joined_values'] = $this->LeaveModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('leave-list', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function get_detail($id)
	{
		$data = $this->LeaveModel->getDataWhere($id);
		echo json_encode($data);
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
		
		$data['positions'] = $this->LeaveModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('leave-form', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function leave_approval()
	{	

		$data['leave_reply_message'] = $this->input->post('rejection_reason');
		$data['leave_status'] = $this->input->post('leave_status');
		$id = $this->input->post('id');
		//var_dump($id); die();
		$query = $this->LeaveModel->updateData($data, $id);

		if($query) {
			redirect('/leaves');	
		}
		
	}

	public function leave_new()
	{	

		$data['leave_message'] = $this->input->post('leave_message');
		$data['leave_date_start'] = $this->input->post('leave_date_start');
		$data['leave_date_end'] = $this->input->post('leave_date_end');
		$data['leave_employee'] = $this->input->post('employee_id');
		$data['leave_status'] = '2'; // 0=rejected, 1= approved, 2 = waiting approval
		//var_dump($data); die();
		$query = $this->LeaveModel->insertData($data);

		if($query) {
			redirect('/leaves');	
		}
		
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
