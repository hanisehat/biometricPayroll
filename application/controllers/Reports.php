<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('ReportModel');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();

		$data['title'] = "Reports List";
		$data['joined_values'] = $this->ReportModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('report-list', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function get_detail($id)
	{
		$data = $this->ReportModel->getDataWhere($id);
		echo json_encode($data);
	}
	
	public function delete($id)
	{
		$del = $this->ReportModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/users');

	}

	public function report_form($id='')
	{
		$this->authent->checkLogin();

		// echo "string";
		if ($id != '') {
			$data['value'] = $this->EmployeeModel->getDataWhere($id)->row();
			$data['title'] = "Add New Report";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Report";

		}
		
		$data['employees'] = $this->ReportModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('report-form', $data, true);
		$this->load->view('templates/main', $data);
	}

/*	public function report_view()
	{	

		$data['employee_name'] = $this->input->post('employee_name');
		$data['employee_salary'] = $this->input->post('employee_salary');
		$id = $this->input->post('id');
		//var_dump($id); die();
		$query = $this->ReportModel->updateData($data, $id);

		if($query) {
			redirect('/reports');	
		}
		
	} */

	public function report_new()
	{	

		$data['report_employee'] = $this->input->post('employee_id');
		$data['report_start'] = $this->input->post('employee_id');
		$data['report_salary'] = $this->input->post('employee_id');
		$query = $this->ReportModel->insertData($data);

		if($query) {
			redirect('/reports');	
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
