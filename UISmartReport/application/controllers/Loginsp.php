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
			if(isset($session_id))
			{
				redirect(base_url());
			} else {
				$data['title'] = 'Special Account Login';
				$data['result'] = '';
				$this->load->view('templates/header', $data);
				$this->load->view('loginspacc');
				$this->load->view('templates/footer');
			}
		}
		else
		{
			$user = $this->Loginsp_model->get_user($this->input->post('username'));
			if($user == null)
			{
				$data['title'] = 'Special Account Login';
				$data['result'] = 'User is not registered';
				$this->load->view('templates/header', $data);
				$this->load->view('loginspacc');
				$this->load->view('templates/footer');
			}
			else
			{
				if($this->Loginsp_model->check_pass($user['Username'], $this->input->post('password')))
				{
					if (substr_count($user['Username'], "admin") == 1) {
						$newdata = array(
							'username'  => $user['Username'],
							'SPAcc' => TRUE,
							'admin' => TRUE
						);
					} else {
						$newdata = array(
							'username'  => $user['Username'],
							'SPAcc' => TRUE,
							'admin' => FALSE
						);
					}
					$this->session->set_userdata($newdata);
					redirect(base_url());
				}
				else
				{
					$data['title'] = 'Special Account Login';
					$data['result'] = 'Wrong password!';
					$this->load->view('templates/header', $data);
					$this->load->view('loginspacc');
					$this->load->view('templates/footer');
				}
			}
		}
	}
}