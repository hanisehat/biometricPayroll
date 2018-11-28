<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendances extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();
				
		$this->load->model('AttendanceModel');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();

		$data['title'] = "Attendance List";
		$data['joined_values'] = $this->AttendanceModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('attendance-list', $data, true);
		$this->load->view('templates/main', $data);
	}


	public function attendance_form($id='')
	{


		// echo "string";
		if ($id != '') {
			$data['value'] = $this->AttendanceModel->getDataWhere($id)->row();
			$data['title'] = "Edit Attendance";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Attendance";

		}
		
		$data['employees'] = $this->AttendanceModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('attendance-form', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function delete($id)
	{
		$del = $this->AttendanceModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/employees');
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
			$command = $this->AttendanceModel->updateData($data, $id);
		} 
		else {

			$message = 'insert';
			$command = $this->AttendanceModel->insertData($data);
		}

		if($message == 'insert') {
			//echo json_encode($message);
			redirect('/attendances');
		} else {
			redirect('/attendances');
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
?>