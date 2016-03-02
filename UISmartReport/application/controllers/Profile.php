<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		require 'application/libraries/SSO/SSO.php';
		$cas_path = 'application/libraries/CAS-1.3.4/CAS.php';
		SSO\SSO::setCASPath($cas_path);

		SSO\SSO::authenticate();
		$user = SSO\SSO::getUser();
		$data['username'] = $user->username;
		$data['name'] = $user->name;
		$data['npm'] = $user->npm;
		$data['role'] = $user->role;
		$data['org_code'] = $user->org_code;
		$data['faculty'] = $user->faculty;
		$data['study_program'] = $user->study_program;
		$data['educational_program'] = $user->educational_program;
		$this->load->view('profile', $data);

	}
}