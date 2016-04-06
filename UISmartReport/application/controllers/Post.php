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
    	redirect('Timeline');	
    }

	public function view($id)
	{
		$session_id = $this->session->userdata('username');
		if(!isset($session_id))
		{
			redirect('Timeline');
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
				$data['isSPAcc'] = $this->session->userdata('SPAcc');
				$this->load->view('postview', $data);
			}
			else
			{
				$newdata = array(
				    'Data'  => $this->input->post('comment'),
				    'PostId' => $id,
				    'OwnerId' => $session_id
				);
				$this->Post_model->insert_comment($newdata);
				$data = $this->Post_model->get_post($id);
				$data['isSPAcc'] = $this->session->userdata('SPAcc');
				$this->load->view('postview', $data);
			}
		}
	}

	public function edit($id)
	{
		$session_id = $this->session->userdata('username');
		$data = $this->Post_model->get_post($id);
		if(!isset($session_id))
		{
			redirect('Timeline');
		}
		else
		{
			if($session_id != $data['OwnerId'])
			{
				redirect('Timeline');
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
				if ($this->session->userdata('username') == $data['OwnerId']) {
					if (substr_count($timespan, "Day") == 0 && substr_count($timespan, "Days") == 0) {
						if (substr_count($timespan, "Hour") == 0 && substr_count($timespan, "Hours") == 0) {
							if ((substr_count($timespan, "Minutes") == 1 || substr_count($timespan, "Minute") == 1) && (intval(substr($timespan, 0, 2)) <= 30)) {
								$is_editable = true;
							} else if (substr_count($timespan, "Seconds") == 1 || substr_count($timespan, "Second") == 1) {
								$is_editable = true;
							}
						}
					}
				}

				if(!$is_editable)
				{
					redirect('Timeline');
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
						$this->load->view('editview', $data);
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
						$config['max_size']             = 100;
						$config['max_width']            = 1024;
						$config['max_height']           = 768;
						$config['file_name'] 			= uniqid();

						$this->upload->initialize($config);
						$this->load->library('upload', $config);

						$attachment = $this->upload->do_upload('userfile');
						$is_attached = $_FILES['userfile']['error'] != 4;
						if (!$attachment && $is_attached)
						{
							$data = $this->Post_model->get_post($id);
							$data['error'] = $this->upload->display_errors();
							$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
							$this->load->view('editview', $data);
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

							$this->Post_model->delete_mention($id);
							if ($this->input->post('mention') != null) {
								foreach ($this->input->post('mention') as $mention) {
									if($mention != null) {
										$newdata2 = array(
											'PostId' => $id,
											'SPAcc' => $mention
										);
										$this->Post_model->insert_mention($newdata2);
									}
								}
							}
							$data['error'] = 'Edit Success!';
							$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
							$this->load->view('editview', $data);
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
		foreach ($post_mentions as $row){
			if ($this->session->userdata('username') == $row->Username) {
				$is_mentioned = true;
			}
		}
		if(!isset($session_id))
		{
			redirect('Timeline');
		}
		else if((isset($session_id) && !$is_sp_acc) || !$is_mentioned)
		{
			redirect('Timeline');
		}
		else
		{
			$this->Post_model->pin_post($id);
			redirect('Timeline');
		}
	}

	public function unpin($id)
	{
		$session_id = $this->session->userdata('username');
		$is_sp_acc = $this->session->userdata('SPAcc');
		$post_mentions = $this->Post_model->get_mentions($id);
		$is_mentioned = false;
		foreach ($post_mentions as $row){
			if ($this->session->userdata('username') == $row->Username) {
				$is_mentioned = true;
			}
		}
		if(!isset($session_id))
		{
			redirect('Timeline');
		}
		else if((isset($session_id) && !$is_sp_acc) || !$is_mentioned)
		{
			redirect('Timeline');
		}
		else
		{
			$this->Post_model->unpin_post($id);
			redirect('Timeline');
		}
	}
}