<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonuses_emp extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();

		$this->load->model('BonusModel_emp');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{	
	//	$this->authent->checkLogin();

		$data['values'] = $this->BonusModel_emp->getAllData();
		$data['employees'] = $this->EmployeeModel->getAllData();
		$data['title'] = "Bonus List";
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('bonus-list-emp', $data, true);
		$this->load->view('templates/main', $data);
	}
	

	public function delete($id)
	{
		$del = $this->BonusModel_emp->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/bonuses_emp');

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
