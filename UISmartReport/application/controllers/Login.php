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
		if(isset($session_id))
		{
			redirect('Timeline');
		}
		else {
			if(!SSO\SSO::check()) {
				SSO\SSO::authenticate();
			}

			$user = SSO\SSO::getUser();
			if($user->role == 'mahasiswa') {
				$npm = $user->npm;
			} else {
				$npm = $user->nip;
			}
			$data1 = array(
		        'Username' => $user->username,
		        'NPM' => $npm,
		        'Role' => $user->role,
		        'Faculty' => $user->faculty
			);
			$data2 = array(
		        'Username' => $data1['Username'],
		        'Name' => $user->name
			);
			if(!$this->Loginuser_model->check_user($data1['Username']))
			{
				$this->Loginuser_model->insert_user($data1, $data2);
			}
			$newdata = array(
			        'username'  => $data1['Username'],
			        'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			redirect('Profile');
		}
	}
}