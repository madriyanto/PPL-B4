<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileSP extends CI_Controller {

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
			redirect('Profile');
		} else if(isset($session_id)) {
			$data = $this->Loginsp_model->get_user($session_id);
			$this->load->view('formsuccess', $data);
		}
		else {
			redirect('Loginsp');
		}
	}
}