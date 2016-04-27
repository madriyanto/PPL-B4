<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper('url');
		$this->load->model('Loginsp_model');
		$this->load->model('Loginuser_model');
		$this->load->model('Setting_model');
		$this->load->model('Notification_model');
    }

	public function index()
	{
		$session_id = $this->session->userdata('username');
		if(isset($session_id) && !$this->Loginsp_model->check_sp($session_id)) {
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('contact', 'Contact', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data = $this->Setting_model->get_user($session_id);
				$data['result'] = '';
				$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
				$datahead['title'] = 'Setting';
				$this->load->view('templates/header', $datahead);
				$this->load->view('settinguser', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				if (!is_dir('uploads')) {
					$oldmask = umask(0);
		            mkdir('./uploads', 0777, true);
		            umask($oldmask);
		        }
				if (!is_dir('uploads/'.$session_id))
			    {
			    	$oldmask = umask(0);
			        mkdir('./uploads/'.$session_id, 0777, true);
			        umask($oldmask);
			    }

			    $config['upload_path']          = './uploads/'.$session_id.'/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 2048;
				$config['file_name'] 			= 'profilepicture';
				$config['overwrite'] 			= TRUE;

				$this->upload->initialize($config);
				$this->load->library('upload', $config);

				$attachment = $this->upload->do_upload('userfile');
				$is_attached = $_FILES['userfile']['error'] != 4;
				if (!$attachment && $is_attached)
				{
					$data = $this->Setting_model->get_user($session_id);
					$data['result'] = $this->upload->display_errors();
					$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
					$datahead['title'] = 'Setting';
					$this->load->view('templates/header', $datahead);
					$this->load->view('settinguser', $data);
					$this->load->view('templates/footer');
				}
				else
				{
					$upload_data = $this->upload->data();
					$path = base_url().'uploads/'.$session_id.'/'.$upload_data['file_name'];
						
					if ($upload_data['image_width'] > 1024) {
						$config['image_library'] 	= 'gd2';
						$config['source_image']		= './uploads/'.$session_id.'/'.$upload_data['file_name'];
						$config['maintain_ratio'] 	= TRUE;
						$config['width']			= 1024;

						$this->load->library('image_lib', $config); 

						$this->image_lib->resize();
					}
						
					if ($upload_data['image_height'] > 1024) {
						$config['image_library'] 	= 'gd2';
						$config['source_image']		= './uploads/'.$session_id.'/'.$upload_data['file_name'];
						$config['maintain_ratio'] 	= TRUE;
						$config['height']			= 1024;

						$this->load->library('image_lib', $config); 

						$this->image_lib->resize();
					}

					if ($attachment) {
						$newdata1 = array(
							'Contact' => $this->input->post('contact'),
							'PictLink' => $path
						);
					} else {
						$newdata1 = array(
							'Contact' => $this->input->post('contact')
						);
					}

					$this->Setting_model->update_user($newdata1, $session_id);
					$data = $this->Setting_model->get_user($session_id);
					$data['result'] = 'Saved!';
					$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
					$datahead['title'] = 'Setting';
					$this->load->view('templates/header', $datahead);
					$this->load->view('settinguser', $data);
					$this->load->view('templates/footer');
				}
			}
		} else if(!isset($session_id)) {
			redirect(base_url());
		} else {
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('contact', 'Contact', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('about', 'About', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data = $this->Setting_model->get_sp_acc($session_id);
				$data['result'] = '';
				$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
				$datahead['title'] = 'Setting';
				$this->load->view('templates/header', $datahead);
				$this->load->view('settingspacc', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				if (!is_dir('uploads')) {
					$oldmask = umask(0);
		            mkdir('./uploads', 0777, true);
		            umask($oldmask);
		        }
				if (!is_dir('uploads/'.$session_id))
			    {
			    	$oldmask = umask(0);
			        mkdir('./uploads/'.$session_id, 0777, true);
			        umask($oldmask);
			    }

			    $config['upload_path']          = './uploads/'.$session_id.'/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 2048;
				$config['file_name'] 			= 'profilepicture';
				$config['overwrite'] 			= TRUE;

				$this->upload->initialize($config);
				$this->load->library('upload', $config);

				$attachment = $this->upload->do_upload('userfile');
				$is_attached = $_FILES['userfile']['error'] != 4;
				if (!$attachment && $is_attached)
				{
					$data = $this->Setting_model->get_sp_acc($session_id);
					$data['result'] = $this->upload->display_errors();
					$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
					$datahead['title'] = 'Setting';
					$this->load->view('templates/header', $datahead);
					$this->load->view('settingspacc', $data);
					$this->load->view('templates/footer');
				}
				else
				{
					$upload_data = $this->upload->data();
					$path = base_url().'uploads/'.$session_id.'/'.$upload_data['file_name'];

					if ($upload_data['image_width'] > 1024) {
						$config['image_library'] 	= 'gd2';
						$config['source_image']		= './uploads/'.$session_id.'/'.$upload_data['file_name'];
						$config['maintain_ratio'] 	= TRUE;
						$config['width']			= 1024;

						$this->load->library('image_lib', $config); 

						$this->image_lib->resize();
					}
						
					if ($upload_data['image_height'] > 1024) {
						$config['image_library'] 	= 'gd2';
						$config['source_image']		= './uploads/'.$session_id.'/'.$upload_data['file_name'];
						$config['maintain_ratio'] 	= TRUE;
						$config['height']			= 1024;

						$this->load->library('image_lib', $config); 

						$this->image_lib->resize();
					}

					if ($attachment) {
						$newdata1 = array(
							'Contact' => $this->input->post('contact'),
							'PictLink' => $path
						);
					} else {
						$newdata1 = array(
							'Contact' => $this->input->post('contact')
						);
					}

					$newdata2 = array(
						'Email' => $this->input->post('email'),
						'About' => $this->input->post('about')
					);

					$this->Setting_model->update_sp_acc($newdata1, $newdata2, $session_id);
					$data = $this->Setting_model->get_sp_acc($session_id);
					$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
					$data['result'] = 'Saved!';
					$datahead['title'] = 'Setting';
					$this->load->view('templates/header', $datahead);
					$this->load->view('settingspacc', $data);
					$this->load->view('templates/footer');
				}
			}
		}
	}
}