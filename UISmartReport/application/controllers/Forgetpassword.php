<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgetpassword extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->helper('email');
		$this->load->model('Loginsp_model');
		$this->load->model('Forgetpass_model');
    }

	public function index()
	{
		$session_id = $this->session->userdata('username');
		if(isset($session_id))
		{
			redirect('Timeline');
		}
		else
		{
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['result'] = '';
				$datahead['title'] = 'Forget Password';
				$this->load->view('templates/header', $datahead);
				$this->load->view('forgetpass', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				$email = $this->input->post('email');
				$account = $this->Forgetpass_model->get_user($email);
				if (valid_email($email) && $account != null) {
					$link = $this->Forgetpass_model->get_encryption($account['Username']);

					$this->email->from('uismartreport@madriyanto.com', 'Administrator');
					$this->email->to($email);
					$this->email->set_mailtype('html');

					$this->email->subject('Reset Password');
					$this->email->message('<h2>Hi '.$account['Name'].',</h2> <h5>Please change your password on the following link below: .</h5> <h5><a href="'.base_url().'updatepassword/update/'.$link.'">'.base_url().'updatepassword/update/'.$link.'</a></h5>');

					$this->email->send();

					$data['result'] = 'Please check your inbox/spam';
				} else if (valid_email($email) && $account == null) {
					$data['result'] = 'Email address is not registered';
				} else {
					$data['result'] = 'Email address is not valid';
				}
				$datahead['title'] = 'Forget Password';
				$this->load->view('templates/header', $datahead);
				$this->load->view('forgetpass', $data);
				$this->load->view('templates/footer');
			}
		}
	}
}