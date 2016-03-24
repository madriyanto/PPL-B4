<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		$session_id = $this->session->userdata('username');
		if(isset($session_id) && !$this->Loginsp_model->check_sp($session_id)) {
			$data = $this->Loginuser_model->get_user($session_id);
			$this->load->view('profile', $data);
		} else if(isset($session_id)) {
			redirect('ProfileSP');
		}
		else {
			redirect('Welcome');
		}
	}
}