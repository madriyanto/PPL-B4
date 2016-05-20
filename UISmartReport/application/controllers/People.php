<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class People extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Loginuser_model');
		$this->load->model('Loginsp_model');
		$this->load->model('Post_model');
		$this->load->model('Timeline_model');
		$this->load->model('Notification_model');
		$this->load->model('Profile_model');
    }

    public function index()
    {
    	redirect(base_url());
    }

    public function view($id)
    {
    	$session_id = $this->session->userdata('username');
		if(!isset($session_id)) {
			redirect(base_url());
		}
		else if($id == $session_id) {
			redirect('profile');
		} else if(!$this->Loginsp_model->check_sp($id)) {
			$data = $this->Loginuser_model->get_user($id);
			$data['timeline'] = $this->Profile_model->retrieve_posts($id);
			$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
			$data['isSPAcc'] = $this->session->userdata('SPAcc');
			$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
			$data['count_posts'] = $this->Post_model->count_posts($id);
			$datahead['title'] = $data['Name'];
			$this->load->view('templates/header', $datahead);
			$this->load->view('profil_user_biasa', $data);
			$this->load->view('templates/footer');
		} else {
			$data = $this->Loginsp_model->get_user($id);
			$data['isSPAcc'] = $this->session->userdata('SPAcc');
			$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
			$data['count_posts'] = $this->Post_model->count_posts($id);
			$data['count_closed_posts'] = $this->Post_model->count_closed_posts($id);
			$datahead['title'] = $data['Name'];
			$this->load->view('templates/header', $datahead);
			$this->load->view('profil_about', $data);
			$this->load->view('templates/footer');
		}	
    }

	public function posts($id)
	{
		$session_id = $this->session->userdata('username');
		if(!isset($session_id)) {
			redirect(base_url());
		}
		else if($id == $session_id) {
			redirect('profile');
		} else if(!$this->Loginsp_model->check_sp($id)) {
			redirect('people/view/'.$id);
		} else {
			$data = $this->Loginsp_model->get_user($id);
			$data['timeline'] = $this->Profile_model->retrieve_posts($id);
			$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
			$data['isSPAcc'] = $this->session->userdata('SPAcc');
			$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
			$data['count_posts'] = $this->Post_model->count_posts($id);
			$data['count_closed_posts'] = $this->Post_model->count_closed_posts($id);
			$datahead['title'] = $data['Name'];
			$this->load->view('templates/header', $datahead);
			$this->load->view('profil_post', $data);
			$this->load->view('templates/footer');
		}
	}

	public function pinned($id)
	{
		$session_id = $this->session->userdata('username');
		if(isset($session_id) && $this->Loginsp_model->check_sp($id) && $session_id != $id && $this->session->userdata('admin')) {
			$data = $this->Loginsp_model->get_user($id);
			$data['timeline'] = $this->Profile_model->retrieve_pinned_posts($id);
			$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
			$data['isSPAcc'] = $this->session->userdata('SPAcc');
			$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
			$data['count_posts'] = $this->Post_model->count_posts($id);
			$data['count_closed_posts'] = $this->Post_model->count_closed_posts($id);
			$datahead['title'] = $data['Name'];
			$this->load->view('templates/header', $datahead);
			$this->load->view('profil_pinned', $data);
			$this->load->view('templates/footer');
		} else {
			redirect('people/view/'.$id);
		}
	}

	public function mention($id)
	{
		$session_id = $this->session->userdata('username');
		if(isset($session_id) && $this->Loginsp_model->check_sp($id) && $session_id != $id && $this->session->userdata('admin')) {

			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('search', 'Search', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data = $this->Loginsp_model->get_user($id);
				$data['timeline'] = $this->Profile_model->retrieve_mention_posts($id);
				$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
				$data['isSPAcc'] = $this->session->userdata('SPAcc');
				$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
				$data['count_posts'] = $this->Post_model->count_posts($id);
				$data['count_closed_posts'] = $this->Post_model->count_closed_posts($id);
				$datahead['title'] = $data['Name'];
				$this->load->view('templates/header', $datahead);
				$this->load->view('profil_mention', $data);
				$this->load->view('templates/footer');
			} else {
				$data = $this->Loginsp_model->get_user($id);
				$data['timeline'] = $this->Profile_model->retrieve_search_posts($id, str_replace(" ", "+", $this->input->post('search')), $this->input->post('status'));
				$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
				$data['isSPAcc'] = $this->session->userdata('SPAcc');
				$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
				$data['count_posts'] = $this->Post_model->count_posts($id);
				$data['count_closed_posts'] = $this->Post_model->count_closed_posts($id);
				$datahead['title'] = $data['Name'];
				$this->load->view('templates/header', $datahead);
				$this->load->view('profil_mention', $data);
				$this->load->view('templates/footer');
			}

		} else {
			redirect('people/view/'.$id);
		}
	}
}