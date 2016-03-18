<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('loginuser_model');
		require 'application/libraries/SSO/SSO.php';
		$cas_path = 'application/libraries/CAS-1.3.4/CAS.php';
		SSO\SSO::setCASPath($cas_path);
    }

	public function index()
	{
		SSO\SSO::authenticate();
		$user = SSO\SSO::getUser();
		$data1 = array(
	        'Username' => $user->username,
	        'NPM' => $user->npm,
	        'Role' => $user->role,
	        'Faculty' => $user->faculty
		);
		$data2 = array(
	        'Username' => $user->username,
	        'Name' => $user->name
		);
		if(!$this->loginuser_model->check_user($data1['Username']))
		{
			$this->loginuser_model->insert_user($data1, $data2);
		}
		$data3 = $this->loginuser_model->get_user($data1['Username']);
		$this->load->view('profile', $data3);
	}
}