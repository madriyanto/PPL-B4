<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct()
    	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->library('upload');
		$this->load->model('Timeline_model');
		$this->load->model('Post_model');
		$this->load->model('Notification_model');
    	}

	public function index()
    	{
    		redirect(base_url());	
    	}

	public function view($id)
	{
		$session_id = $this->session->userdata('username');
		if(!isset($session_id))
		{
			redirect(base_url());
		}
		else
		{
			if ($this->Notification_model->is_unread($session_id, $id)) {
				$this->Notification_model->set_read($session_id, $id);
			}

			$this->load->library('form_validation');

			$this->form_validation->set_rules('comment', 'Comment', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$data = $this->Post_model->get_post($id);
				if ($data == null || !$data['IsViewable']) {
					redirect(base_url());
				}
				$data['isSPAcc'] = $this->session->userdata('SPAcc');
				$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
				$datahead['title'] = 'Post Detail';
				$this->load->view('templates/header', $datahead);
				$this->load->view('postview', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				$newdata = array(
				    'Data'  => str_replace('>', '&gt;', str_replace('<', '&lt;', $this->input->post('comment'))),
				    'PostId' => $id,
				    'OwnerId' => $session_id
				);
				$this->Post_model->insert_comment($newdata);
				$data = $this->Post_model->get_post($id);
				if ($session_id != $data['OwnerId']) {
					$newdata2 = array(
						'Dest'  => $data['OwnerId'],
						'Origins' => $session_id,
						'PostId'  => $id,
						'NotesId' => 1
					);
					$this->Notification_model->insert($newdata2);
				}
				$mentions = $this->Post_model->get_mentions($id);
				foreach ($mentions as $row) {
					if ($session_id != $row->Username || $data['OwnerId'] != $row->Username) {
						$newdata2 = array(
							'Dest'  => $row->Username,
							'Origins' => $session_id,
							'PostId'  => $id,
							'NotesId' => 7
						);
						$this->Notification_model->insert($newdata2);
					}
				}
				$commenters = $this->Post_model->get_commenters($id, $session_id);
				foreach ($commenters as $row) {
					$newdata3 = array(
						'Dest'  => $row->Origins,
						'Origins' => $session_id,
						'PostId'  => $id,
						'NotesId' => 6
					);
					$this->Notification_model->insert($newdata3);
				}
				$data['isSPAcc'] = $this->session->userdata('SPAcc');
				$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
				$datahead['title'] = 'Post Detail';
				$this->load->view('templates/header', $datahead);
				$this->load->view('postview', $data);
				$this->load->view('templates/footer');
			}
		}
	}

	public function edit($id)
	{
		$session_id = $this->session->userdata('username');
		$data = $this->Post_model->get_post($id);
		if(!isset($session_id))
		{
			redirect(base_url());
		}
		else
		{
			if($session_id != $data['OwnerId'])
			{
				redirect(base_url());
			}
			else
			{
				date_default_timezone_set("Asia/Jakarta");
				$timestamp = mysql_to_unix($data['Timestamp']);
				$timespan = timespan($timestamp)." Ago";

				if ((now() - $timestamp) >= (24*60*60)) {
					$timespan = date('F d, Y', $timestamp);
				}

				$is_editable = false;
				if ($this->session->userdata('username') == $data['OwnerId'] && (now() - $timestamp) <= (30*60)) {
					$is_editable = true;
				}

				if(!$is_editable)
				{
					redirect(base_url());
				}
				else
				{
					$this->load->helper(array('form', 'url'));

					$this->load->library('form_validation');

					$this->form_validation->set_rules('title', 'Title', 'required');
					$this->form_validation->set_rules('post', 'Post', 'required');

					if ($this->form_validation->run() == FALSE)
					{
						$data = $this->Post_model->get_post($id);
						$data['error'] = '';
						$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
						$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
						$data['post_mentions'] = $this->Post_model->get_mentions($id);
						$datahead['title'] = 'Edit Post';
						$this->load->view('templates/header', $datahead);
						$this->load->view('editview', $data);
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
							$data = $this->Post_model->get_post($id);
							$data['error'] = $this->upload->display_errors();
							$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
							$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
							$data['post_mentions'] = $this->Post_model->get_mentions($id);
							$datahead['title'] = 'Edit Post';
							$this->load->view('templates/header', $datahead);
							$this->load->view('editview', $data);
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
								        'Title' => $this->input->post('title'),
								        'Data' => $this->input->post('post'),
								        'IsAnonymous' => true,
								        'Attachments' => $path
									);
								}
								else
								{
									$newdata1 = array(
								        'Title' => $this->input->post('title'),
								        'Data' => $this->input->post('post'),
								        'IsAnonymous' => true
									);
								}
							}
							else
							{
								if($attachment)
								{
									$newdata1 = array(
								        'Title' => $this->input->post('title'),
								        'Data' => $this->input->post('post'),
								        'Attachments' => $path
									);
								}
								else
								{
									$newdata1 = array(
								        'Title' => $this->input->post('title'),
								        'Data' => $this->input->post('post')
										);
								}
							}

							$this->Post_model->edit_post($newdata1, $id);

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

							$this->Post_model->delete_mention($id);
							$this->Notification_model->delete($id, 2);
							if ($this->input->post('mention') != null) {
								foreach (explode(", ", $this->input->post('mention')) as $mention) {
									if($mention != null) {
										$newdata2 = array(
											'PostId'  => $id,
											'SPAcc' => $mention
										);
										$this->Post_model->insert_mention($newdata2);
										
										$newdata3 = array(
											'Dest'  => $mention,
											'Origins' => $session_id,
											'PostId'  => $id,
											'NotesId' => 2
										);
										$this->Notification_model->insert($newdata3);
									}
								}
							}
							$data['error'] = 'Edit Success!';
							$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
							$data['count_notif'] = $this->Notification_model->count_notif($this->session->userdata('username'));
							$data['post_mentions'] = $this->Post_model->get_mentions($id);
							$datahead['title'] = 'Edit Post';
							$this->load->view('templates/header', $datahead);
							$this->load->view('editview', $data);
							$this->load->view('templates/footer');
						}
					}
				}
			}
		}
	}
	
	public function pin($id)
	{
		$session_id = $this->session->userdata('username');
		$is_sp_acc = $this->session->userdata('SPAcc');
		$post_mentions = $this->Post_model->get_mentions($id);
		$is_mentioned = false;
		$data = $this->Post_model->get_post($id);
		foreach ($post_mentions as $row){
			if ($this->session->userdata('username') == $row->Username) {
				$is_mentioned = true;
			}
		}
		if(!isset($session_id))
		{
			redirect(base_url());
		}
		else if((isset($session_id) && !$is_sp_acc) || !$is_mentioned || $data == null)
		{
			redirect(base_url());
		}
		else
		{
			$this->Post_model->pin_post($id);
			$newdata = array(
				'Dest'  => $data['OwnerId'],
				'Origins' => $session_id,
				'PostId'  => $id,
				'NotesId' => 3
			);
			$this->Notification_model->insert($newdata);
			redirect(base_url().'post/view/'.$id);
		}
	}

	public function unpin($id)
	{
		$session_id = $this->session->userdata('username');
		$is_sp_acc = $this->session->userdata('SPAcc');
		$post_mentions = $this->Post_model->get_mentions($id);
		$is_mentioned = false;
		$data = $this->Post_model->get_post($id);
		foreach ($post_mentions as $row){
			if ($this->session->userdata('username') == $row->Username) {
				$is_mentioned = true;
			}
		}
		if(!isset($session_id))
		{
			redirect(base_url());
		}
		else if((isset($session_id) && !$is_sp_acc) || !$is_mentioned || $data == null)
		{
			redirect(base_url());
		}
		else
		{
			$this->Post_model->unpin_post($id);
			$newdata = array(
				'Dest'  => $data['OwnerId'],
				'Origins' => $session_id,
				'PostId'  => $id,
				'NotesId' => 4
			);
			$this->Notification_model->insert($newdata);
			redirect(base_url().'post/view/'.$id);
		}
	}

	public function close($id)
	{
		$session_id = $this->session->userdata('username');
		$is_sp_acc = $this->session->userdata('SPAcc');
		$post_mentions = $this->Post_model->get_mentions($id);
		$is_mentioned = false;
		$data = $this->Post_model->get_post($id);
		foreach ($post_mentions as $row){
			if ($this->session->userdata('username') == $row->Username) {
				$is_mentioned = true;
			}
		}
		if(!isset($session_id))
		{
			redirect(base_url());
		}
		else if((isset($session_id) && !$is_sp_acc) || !$is_mentioned || $data == null)
		{
			redirect(base_url());
		}
		else
		{
			$this->Post_model->close_post($id);
			$newdata = array(
				'Dest'  => $data['OwnerId'],
				'Origins' => $session_id,
				'PostId'  => $id,
				'NotesId' => 5
			);
			$this->Notification_model->insert($newdata);
			redirect(base_url().'post/view/'.$id);
		}
	}

	public function delete($id)
	{
		$session_id = $this->session->userdata('username');
		$data = $this->Post_model->get_post($id);
		if(!isset($session_id))
		{
			redirect(base_url());
		}
		else if($session_id != $data['OwnerId'] || $data == null)
		{
			redirect(base_url());
		}
		else
		{
			date_default_timezone_set("Asia/Jakarta");
			$timestamp = mysql_to_unix($data['Timestamp']);
			$is_editable = false;

			if ((now() - $timestamp) <= (30*60)) {
				$is_editable = true;
			}

			if(!$is_editable)
			{
				redirect(base_url());
			}
			else
			{
				$this->Post_model->delete_post($id);
				redirect(base_url());
			}
		}
	}
}
