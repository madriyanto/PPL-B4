<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Loginuser_model');
		$this->load->model('Loginsp_model');
		require 'application/libraries/SSO/SSO.php';
		$cas_path = 'application/libraries/CAS-1.3.4/CAS.php';
		SSO\SSO::setCASPath($cas_path);
    }

	public function index()
	{
		$session_id = $this->session->userdata('username');
		if(isset($session_id) && !$this->Loginsp_model->check_sp($session_id))
		{
			redirect('profile');
		}
		else if(isset($session_id)) {
			redirect('loginsp');
		}
		else {
			if(!SSO\SSO::check())
			{
				SSO\SSO::authenticate();
			}
			$user = SSO\SSO::getUser();
			$data1 = array(
		        'Username' => $user->username,
		        'NPM' => $user->npm,
		        'Role' => $user->role,
		        'Faculty' => $user->faculty
			);
			$data2 = array(
		        'Username' => $data1['Username'],
		        'Name' => $user->name
			);
			if(!$this->loginuser_model->check_user($data1['Username']))
			{
				$this->loginuser_model->insert_user($data1, $data2);
			}
			$newdata = array(
			        'username'  => $data1['Username'],
			        'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			redirect('profile');
		}
	}
}