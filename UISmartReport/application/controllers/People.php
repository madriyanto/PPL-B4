<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class People extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Loginuser_model');
		$this->load->model('Loginsp_model');
    }

    public function index()
    {
    	redirect('Timeline');	
    }

	public function view($id)
	{
		$session_id = $this->session->userdata('username');
		if($id == $session_id) {
			redirect('Profile');
		} else if(!$this->Loginsp_model->check_sp($id)) {
			$data = $this->Loginuser_model->get_user($id);
			$this->load->view('profile', $data);
		} else {
			$data = $this->Loginsp_model->get_user($id);
			$this->load->view('formsuccess', $data);
		}
	}
}