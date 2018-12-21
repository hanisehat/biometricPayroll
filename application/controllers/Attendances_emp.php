<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendances_emp extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();
				
		$this->load->model('AttendanceModel_emp');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();

		$data['title'] = "Attendance List";
		$data['joined_values'] = $this->AttendanceModel_emp->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('attendance-list-emp', $data, true);
		$this->load->view('templates/main', $data);
	}


	public function attendance_form($id='')
	{


		// echo "string";
		if ($id != '') {
			$data['value'] = $this->AttendanceModel_emp->getDataWhere($id)->row();
			$data['title'] = "Edit Attendance";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Attendance";

		}
		
		$data['employees'] = $this->AttendanceModel_emp->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('attendance-form-emp', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function delete($id)
	{
		$del = $this->AttendanceModel_emp->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/attendances_emp');
	}


	public function update_attendance($id='')
	{	
    
		$id = $this->input->post('id');

		
		$data['attendance_employee'] = $this->input->post('attendance_name');
		$data['attendance_in'] = $this->input->post('attendance_in');
		$data['attendance_out'] = $this->input->post('attendance_out');
		
		//if($this->)

		if( is_numeric($id) ) {
			
			$message = 'update';
			$command = $this->AttendanceModel_emp->updateData($data, $id);
		} 
		else {

			$message = 'insert';
			$command = $this->AttendanceModel_emp->insertData($data);
		}

		if($message == 'insert') {
			//echo json_encode($message);
			redirect('/attendances_emp');
		} else {
			redirect('/attendances_emp');
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
?>