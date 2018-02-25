<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {

		function __construct(){
		parent:: __construct();
		$this->load->model('teacher_model','teachers');
		$this->load->model('class_model','_class');
		$this->load->model('student_model','student');
		
		if(!($this->session->userdata['logged_in']))
		{
			redirect('login');
		}


	}


				public function do_upload(){
					$name=$this->input->post('name');
					$class=$this->input->post('class');

		$config = array(
		'upload_path' => "./uploads/",
		'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
		'overwrite' => TRUE,
		'max_size' => "25000000"
		);
		$this->load->library('upload',$config);
		if($this->upload->do_upload())
		{
		$data = array('upload_data' => $this->upload->data());
		$file=$this->upload->data();
		$user=$this->session->userdata['logged_in']['username'] . "|".$this->session->userdata['logged_in']['name'];
		$filename=$file['file_name'];
		$filepath=base_url()."uploads/".$filename;
					$datum=array(
						'db'=>"acapp_db",
						'table'=>"modules",
						'fields'=>array(
							'filedesc'=>$name,
							'classcode'=>$class,
							'filepath'=>$filepath,
							'createdby'=>$user));
		$result=$this->crud->insert($datum);
		if($result == 1)
		{
				
			redirect(base_url()."Main/modules_index");
		}
		else
		{
			redirect(base_url()."Main/modules_index");
		}
		}
		else
		{

		}
		}
	}
