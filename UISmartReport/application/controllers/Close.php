<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Close extends CI_Controller {

	public function index()
	{
		require 'application/libraries/SSO/SSO.php';
		$cas_path = 'application/libraries/CAS-1.3.4/CAS.php';
		SSO\SSO::setCASPath($cas_path);

		SSO\SSO::logout();

	}
}
