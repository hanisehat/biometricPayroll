<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claims_emp extends CI_Controller
{

	function __construct() 
	{
		parent::__construct();
				
		$this->load->model('ClaimModel_emp');
		$this->load->model('EmployeeModel');
		//$this->load->library('Authent');
		//$this->notifications->checkDraft();
	}


	public function index()
	{
		$this->authent->checkLogin();

		$data['title'] = "Claim List";
		$data['joined_values'] = $this->ClaimModel_emp->getAllData();
		$data['employees'] = $this->EmployeeModel->getAllData();
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('claim-list-emp', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function claim_form($id='')
	{
		
		if ($id != '') {
			$data['value'] = $this->ClaimModel_emp->getDataWhere($id)->row();
			$data['title'] = "Edit Claim";

		} else {
			$data['value'] = '';
			$data['title'] = "Add New Claim";

		}
		
		$data['footer'] = $this->footer();
		$data['sidebar']= $this->sidebar();
		$data['header']= $this->header();
		$data['content'] = $this->load->view('claim-form-emp', $data, true);
		$this->load->view('templates/main', $data);
	}

	public function delete($id)
	{
		$del = $this->ClaimModel_emp->deleteData($id);
		if( $del ) {
			$this->session->set_flashdata('success', 'Data user berhasil dihapus');
		} else {
			$this->session->set_flashdata('fail', 'Kesalahan penghapusan data terjadi.');
		}

		redirect('/claims_emp');
	}

	

	public function update_claim($id='')
	{	
		$config['upload_path']          = './files/claim_pictures';
        $config['allowed_types']        = 'jpg|jpeg|png|PNG|JPG|JPEG';
        $config['max_size']             = 5000;
        $config['encrypt_name']         = true;

        $this->load->library('upload', $config);
    
		$id = $this->input->post('id');

		$claim_pictures = $_FILES["c_picture"]["name"];

		$data['claim_user'] = $this->input->post('employee_id');
		$data['claim_title'] = $this->input->post('c_title');
		$data['claim_status'] = $this->input->post('c_status');
		$data['claim_date'] = $this->input->post('c_date');
		$data['claim_description'] = $this->input->post('desc');
		
		//if($this->)

		if( is_numeric($id) ) {
			
			if (!empty($c_picture)) {
				$this->upload->do_upload('c_picture');
    			$image_upload = $this->upload->data();

    			$data['claim_picture'] = 'files/claim_pictures/'.$this->upload->file_name;
			}
			
			$message = 'update';
			$command = $this->ClaimModel_emp->updateData($data, $id);
		} 
		else {
			 	if (!empty($c_picture)) {
					$this->upload->do_upload('c_picture');
	    			$image_upload = $this->upload->data();

	    			$data['claim_picture'] = 'files/claim_pictures/'.$this->upload->file_name;
				}

				$message = 'insert';
			
			$command = $this->ClaimModel_emp->insertData($data);
		}

		if($message == 'insert') {
			//echo json_encode($message);
			redirect('/claims_emp');
		} else {
			redirect('/claims_emp/claim_form/'.$id);
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
		$config['upload_path']          = './files/claim_pictures/';
        $config['allowed_types']        = 'jpg||jpeg||png||PNG||JPG||JPEG';
        $config['max_size']             = 5000;

        $this->load->library('upload', $config);
    
        $this->upload->do_upload('c_picture');
        $image_upload = $this->upload->data();

		$c_picture = $_FILES["c_picture"]["name"];
		
		$id = $this->input->post('id');

		if( is_numeric($id) && empty($c_picture)) {

			$data = array(
				'claim_user' => $this->input->post('c_name'),
				'claim_title' => $this->input->post('c_title'),
				'claim_status' => $this->input->post('c_status'),
				'claim_date' => $this->input->post('c_date'),
				'claim_description' => $this->input->post('desc')
			);	
		
		} 
		else {

			$data = array(
				'claim_user' => $this->input->post('c_name'),
				'claim_title' => $this->input->post('c_title'),
				'claim_status' => $this->input->post('c_status'),
				'claim_date' => $this->input->post('c_date'),
				'claim_picture' => $config['upload_path'].$c_picture,
				'claim_description' => $this->input->post('desc')
			);
		}

		if (is_numeric($id)) {
			$query = $this->ClaimModel_emp->updateData($id, $data);
		} else {
			$query = $this->ClaimModel_emp->insertData($data);	
		}
		
		if($query) {
			redirect('/claims_emp');
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