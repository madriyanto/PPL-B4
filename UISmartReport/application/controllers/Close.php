<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Close extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('logout_model');
		require 'application/libraries/SSO/SSO.php';
		$cas_path = 'application/libraries/CAS-1.3.4/CAS.php';
		SSO\SSO::setCASPath($cas_path);
    }

	public function index()
	{
		$this->session->sess_destroy();
		redirect('Welcome');
	}
}
