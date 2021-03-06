<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('Timeline_model');
		$this->load->model('Post_model');
		$this->load->model('Notification_model');
		$this->load->model('Loginuser_model');
		$this->load->model('Loginsp_model');
    }

	public function index()
	{
		$session_id = $this->session->userdata('username');
		if(!isset($session_id))
		{
			$data['title'] = 'Homepage';
			$this->load->view('templates/header', $data);
			$this->load->view('homepage');
			$this->load->view('templates/footer');
		}
		else
		{
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('post', 'Post', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				if ($this->session->userdata('SPAcc')) {
					$data = $this->Loginsp_model->get_user($this->session->userdata('username'));
				} else {
					$data = $this->Loginuser_model->get_user($this->session->userdata('username'));
				}
				$data['error'] = '';
				$data['timeline'] = $this->Timeline_model->retrieve_posts(1);
				$data['isSPAcc'] = $this->session->userdata('SPAcc');
				$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
				$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
				$data['page'] = 1;
				$datahead['title'] = 'Timeline';
				$this->load->view('templates/header', $datahead);
				$this->load->view('tlview', $data);
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
				$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
				$config['max_size']             = 2048;
				$config['encrypt_name'] 		= TRUE;

				$this->upload->initialize($config);
				$this->load->library('upload', $config);

				$attachment = $this->upload->do_upload('userfile');
				$is_attached = $_FILES['userfile']['error'] != 4;
				if (!$attachment && $is_attached)
				{
					if ($this->session->userdata('SPAcc')) {
						$data = $this->Loginsp_model->get_user($this->session->userdata('username'));
					} else {
						$data = $this->Loginuser_model->get_user($this->session->userdata('username'));
					}
					$data['error'] = $this->upload->display_errors();
					$data['timeline'] = $this->Timeline_model->retrieve_posts(1);
					$data['isSPAcc'] = $this->session->userdata('SPAcc');
					$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
					$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
					$data['page'] = 1;
					$datahead['title'] = 'Timeline';
					$this->load->view('templates/header', $datahead);
					$this->load->view('tlview', $data);
					$this->load->view('templates/footer');
				}
				else
				{
					$upload_data = $this->upload->data();
					$path = base_url().'uploads/'.$session_id.'/'.$upload_data['file_name'];

					if($this->input->post('anonymous') == 'true')
					{
						if($attachment)
						{
							$newdata1 = array(
						        'OwnerId'  => $session_id,
						        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
						        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post'))),
						        'IsAnonymous' => true,
						        'Attachments' => $path
							);
						}
						else
						{
							$newdata1 = array(
						        'OwnerId'  => $session_id,
						        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
						        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post'))),
						        'IsAnonymous' => true
							);
						}
					}
					else
					{
						if($attachment)
						{
							$newdata1 = array(
						        'OwnerId'  => $session_id,
						        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
						        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post'))),
						        'Attachments' => $path
							);
						}
						else
						{
							$newdata1 = array(
						        'OwnerId'  => $session_id,
						        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
						        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post')))
								);
						}
					}

					$this->Post_model->insert_post($newdata1);
					
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

					if ($this->input->post('mention') != null) {
						foreach (explode(", ", $this->input->post('mention')) as $mention) {
							if($mention != null) {
								$newdata2 = array(
									'PostId'  => $this->Post_model->get_lastest_post_id(),
									'SPAcc' => $mention
								);
								$this->Post_model->insert_mention($newdata2);
								
								if($mention != $session_id) {
									$newdata3 = array(
										'Dest'  => $mention,
										'Origins' => $session_id,
										'PostId'  => $this->Post_model->get_lastest_post_id(),
										'NotesId' => 2
									);
									$this->Notification_model->insert($newdata3);
								}
							}
						}
					}
					$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
					$datahead['title'] = 'Timeline';
					$this->load->view('templates/header', $datahead);
					$this->load->view('afterpost', $data);
					$this->load->view('templates/footer');
				}
			}
		}
	}
	
	public function page($page)
	{
		$session_id = $this->session->userdata('username');
		if(!isset($session_id))
		{
			$data['title'] = 'Homepage';
			$this->load->view('templates/header', $data);
			$this->load->view('homepage');
			$this->load->view('templates/footer');
		}
		else
		{
			if ($page == 1) {
				redirect(base_url());
			} else {
				$this->load->helper(array('form', 'url'));

				$this->load->library('form_validation');

				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('post', 'Post', 'required');

				if ($this->form_validation->run() == FALSE)
				{
					if ($this->session->userdata('SPAcc')) {
						$data = $this->Loginsp_model->get_user($this->session->userdata('username'));
					} else {
						$data = $this->Loginuser_model->get_user($this->session->userdata('username'));
					}
					$data['error'] = '';
					$data['timeline'] = $this->Timeline_model->retrieve_posts($page);
					$data['isSPAcc'] = $this->session->userdata('SPAcc');
					$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
					$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
					$data['page'] = $page;
					$datahead['title'] = 'Timeline';
					$this->load->view('templates/header', $datahead);
					$this->load->view('tlview', $data);
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
					$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['max_size']             = 2048;
					$config['encrypt_name'] 		= TRUE;

					$this->upload->initialize($config);
					$this->load->library('upload', $config);

					$attachment = $this->upload->do_upload('userfile');
					$is_attached = $_FILES['userfile']['error'] != 4;
					if (!$attachment && $is_attached)
					{
						if ($this->session->userdata('SPAcc')) {
							$data = $this->Loginsp_model->get_user($this->session->userdata('username'));
						} else {
							$data = $this->Loginuser_model->get_user($this->session->userdata('username'));
						}
						$data['error'] = $this->upload->display_errors();
						$data['timeline'] = $this->Timeline_model->retrieve_posts($page);
						$data['isSPAcc'] = $this->session->userdata('SPAcc');
						$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
						$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
						$data['page'] = $page;
						$datahead['title'] = 'Timeline';
						$this->load->view('templates/header', $datahead);
						$this->load->view('tlview', $data);
						$this->load->view('templates/footer');
					}
					else
					{
						$upload_data = $this->upload->data();
						$path = base_url().'uploads/'.$session_id.'/'.$upload_data['file_name'];

						if($this->input->post('anonymous') == 'true')
						{
							if($attachment)
							{
								$newdata1 = array(
							        'OwnerId'  => $session_id,
							        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
							        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post'))),
							        'IsAnonymous' => true,
							        'Attachments' => $path
								);
							}
							else
							{
								$newdata1 = array(
							        'OwnerId'  => $session_id,
							        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
							        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post'))),
							        'IsAnonymous' => true
								);
							}
						}
						else
						{
							if($attachment)
							{
								$newdata1 = array(
							        'OwnerId'  => $session_id,
							        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
							        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post'))),
							        'Attachments' => $path
								);
							}
							else
							{
								$newdata1 = array(
							        'OwnerId'  => $session_id,
							        'Title' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('title'))),
							        'Data' => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('post')))
									);
							}
						}

						$this->Post_model->insert_post($newdata1);
						
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

						if ($this->input->post('mention') != null) {
							foreach (explode(", ", $this->input->post('mention')) as $mention) {
								if($mention != null) {
									$newdata2 = array(
										'PostId'  => $this->Post_model->get_lastest_post_id(),
										'SPAcc' => $mention
									);
									$this->Post_model->insert_mention($newdata2);
									
									$newdata3 = array(
										'Dest'  => $mention,
										'Origins' => $session_id,
										'PostId'  => $this->Post_model->get_lastest_post_id(),
										'NotesId' => 2
									);
									$this->Notification_model->insert($newdata3);
								}
							}
						}
						$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
						$datahead['title'] = 'Timeline';
						$this->load->view('templates/header', $datahead);
						$this->load->view('afterpost', $data);
						$this->load->view('templates/footer');
					}
				}
			}
		}
	}
}