<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginsp extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('Loginsp_model');
		$this->load->library('session');
    }

	public function index()
    {
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$session_id = $this->session->userdata('username');
			if(isset($_SESSION['username']))
			{
				$user = $this->Loginsp_model->get_user($session_id);
				$this->load->view('formsuccess', $user);
			}
			else {
				$this->load->view('loginspacc');
			}
		}
		else
		{
			$user = $this->Loginsp_model->get_user($this->input->post('username'));
			if($user == null)
			{
				$this->load->view('loginspacc');
			}
			else
			{
				if($this->Loginsp_model->check_pass($user['Username'], $this->input->post('password')))
				{
					$newdata = array(
				        'username'  => $user['Username'],
				        'logged_in' => TRUE
					);
					$this->session->set_userdata($newdata);
					$this->load->view('formsuccess', $user);
				}
				else
				{
					$this->load->view('loginspacc');
				}
			}
		}
	}

	public function username_check($str)
	{
		if ($str == 'test')
		{
			$this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}