<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginsp extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('Loginsp_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
    }

	public function index()
    {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$session_id = $this->session->userdata('username');
			if(isset($session_id) && $this->Loginsp_model->check_sp($session_id))
			{
				redirect('profilesp');
			}
			else if(isset($session_id)) {
				redirect('profile');
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
					redirect('profilesp');
				}
				else
				{
					$this->load->view('loginspacc');
				}
			}
		}
	}
}