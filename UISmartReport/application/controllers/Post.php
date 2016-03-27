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
			redirect('Welcome');
		}
		else
		{
			$data = $this->Timeline_model->get_post($id);
			$data['isSPAcc'] = $this->session->userdata('SPAcc');
			$this->load->view('postview', $data);
		}
	}

	public function edit($id)
	{
		$session_id = $this->session->userdata('username');
		$data = $this->Timeline_model->get_post($id);
		$data['to'] = $this->Timeline_model->get_mentions($id);
		if(!isset($session_id))
		{
			redirect('Welcome');
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
						$data = $this->Timeline_model->get_post($id);
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
							$data = $this->Timeline_model->get_post($id);
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

							$this->Timeline_model->edit_post($newdata1, $id);

							$newdata2 = array(
								'SPAcc' => $this->input->post('mention')
							);
							$this->Timeline_model->edit_mention($newdata2, $id);

							$data['error'] = 'Edit Success!';
							$data['mention'] = $this->Timeline_model->retrieve_sp_acc();
							$this->load->view('editview', $data);
						}
					}
				}
			}
		}
	}
}