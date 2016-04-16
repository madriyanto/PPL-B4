<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatepassword extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Loginsp_model');
		$this->load->model('Forgetpass_model');
    }

	public function index()
    {
    	redirect(base_url());	
    }
	
	public function update($encryption)
	{
		$session_id = $this->session->userdata('username');
		if(isset($session_id)) {
			redirect(base_url());
		} else {
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('newpass', 'New Password', 'min_length[8]|alpha_numeric|required');
			$this->form_validation->set_rules('passconf', 'Password Confrmation', 'required|matches[newpass]');

			if ($this->form_validation->run() == FALSE)
			{
				if ($this->Forgetpass_model->check_encryption($encryption)) {
					$data['result'] = '';
					$data['encryption'] = $encryption;
					$datahead['title'] = 'Upddate Password';
					$this->load->view('templates/header', $datahead);
					$this->load->view('forgetupdatepass', $data);
					$this->load->view('templates/footer');
				} else {
					redirect(base_url());
				}
			}
			else
			{
				$this->Forgetpass_model->update_pass_encryption($encryption, $this->input->post('newpass'));
				$data['result'] = 'Password changed!';
				$data['encryption'] = $encryption;
				$datahead['title'] = 'Update Password';
				$this->load->view('templates/header', $datahead);
				$this->load->view('forgetupdatepass', $data);
				$this->load->view('templates/footer');
			}
		}
	}
}