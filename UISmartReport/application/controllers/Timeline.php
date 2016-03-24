<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Timeline_model');
    }

	public function index()
	{
		$session_id = $this->session->userdata('username');
		if(!isset($session_id))
		{
			redirect('Welcome');
		}
		else
		{
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('post', 'Post', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data['timeline'] = $this->Timeline_model->retrieve_posts();
				$this->load->view('tlview', $data);
			}
			else
			{
				if($this->input->post('anonymous') == 'true')
				{
					$newdata1 = array(
					        'OwnerId'  => $session_id,
					        'Data' => $this->input->post('post'),
					        'IsAnonymous' => true
					);
				}
				else
				{
					$newdata1 = array(
					        'OwnerId'  => $session_id,
					        'Data' => $this->input->post('post')
					);
				}
				$this->Timeline_model->insert_post($newdata1);
				$data['timeline'] = $this->Timeline_model->retrieve_posts();
				$this->load->view('tlview', $data);
			}
		}
	}
}