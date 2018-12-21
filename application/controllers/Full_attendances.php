<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Full_attendances extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();
				
		$this->load->model('FullAttendanceModel');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();

		$data['title'] = "Attendance List";
		$data['joined_values'] = $this->FullAttendanceModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('full_attendance_list', $data, true);
		$this->load->view('templates/main', $data);
	}


	public function attendance_form($id='')
	{

		if ($id != '') {
			$data['value'] = $this->FullAttendanceModel->getDataWhere($id)->row();
			$data['title'] = "Edit Attendance";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Attendance";

		}
		
		$data['employees'] = $this->FullAttendanceModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('full-attendance-form', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function delete($id)
	{
		$del = $this->FullAttendanceModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/full_attendances');
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
			$command = $this->FullAttendanceModel->updateData($data, $id);
		} 
		else {

			$message = 'insert';
			$command = $this->FullAttendanceModel->insertData($data);
		}

		if($message == 'insert') {
			//echo json_encode($message);
			redirect('/full_attendances');
		} else {
			redirect('/full_attendances');
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
		return $this->load->view('templates/header_admin', $data, true);
	}

	public function footer()
	{
		$data = array();
		return $this->load->view('templates/footer', $data, true);
	}
}
?>