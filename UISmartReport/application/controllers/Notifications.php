<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Loginuser_model');
		$this->load->model('Loginsp_model');
		$this->load->model('Notification_model');
    }

	public function index()
	{
		$session_id = $this->session->userdata('username');
		if(isset($session_id)) {
			$data['notif'] = $this->Notification_model->get($session_id);
			$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
			$datahead['title'] = 'Notifications';
			$this->load->view('templates/header', $datahead);
			$this->load->view('notif', $data);
			$this->load->view('templates/footer');
		}
		else {
			redirect(base_url());
		}
	}
}