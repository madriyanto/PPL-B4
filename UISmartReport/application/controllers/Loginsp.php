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
		$data['title'] = "Login Special Account";
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$session_id = $this->session->userdata('username');
			if(isset($session_id))
			{
				redirect('Timeline');
			} else {
				$this->load->view('templates/header', $data);
				$this->load->view('loginspacc');
				$this->load->view('templates/footer', $data);
			}
		}
		else
		{
			$user = $this->Loginsp_model->get_user($this->input->post('username'));
			if($user == null)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('loginspacc');
				$this->load->view('templates/footer', $data);
			}
			else
			{
				if($this->Loginsp_model->check_pass($user['Username'], $this->input->post('password')))
				{
					$newdata = array(
				        'username'  => $user['Username'],
				        'SPAcc' => TRUE
					);
					$this->session->set_userdata($newdata);
					redirect('Timeline');
				}
				else
				{
					$this->load->view('templates/header', $data);
					$this->load->view('loginspacc');
					$this->load->view('templates/footer', $data);
				}
			}
		}
	}
}
