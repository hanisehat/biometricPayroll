<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonuses extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('BonusModel');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{	
	//	$this->authent->checkLogin();

		$data['values'] = $this->BonusModel->getAllData();
		$data['employees'] = $this->EmployeeModel->getAllData();
		$data['title'] = "Bonus List";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('bonus-list', $data, true);
		$this->load->view('templates/main', $data);
	}
	

	public function delete($id)
	{
		$del = $this->BonusModel->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/bonuses');

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

		$data['bonus_employee'] = $this->input->post('bonus_name');
		$data['bonus_type'] = $this->input->post('bonus_type');
		$data['bonus_amount'] = $this->input->post('bonus_amount');
		//$data['bonus_timestamp'] = $this->input->post('')

		if(is_numeric($id))	 {
			
			$runQuery = $this->BonusModel->updateData($data, $id);

					// if($runQuery){
					// 	$this->session->set_flashdata('success', 'Position has been added');
					// } else {
					// 	$this->session->set_flashdata('fail', 'Kesalahan penyimpanan terjadi.');
					// }
		} else {
		 	$runQuery = $this->BonusModel->insertData($data);
			
		}

		redirect('/bonuses/');

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
