<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
			function __construct(){
		parent:: __construct();
		$this->load->model('account_model','account');

	}


	function logout(){
		session_destroy();
		redirect('/login');
	}


	function login(){
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login');
	}
	function login_process()
	{
		$email=$this->input->post('email');
		$pass=md5($this->input->post('password'));

		$result=$this->account->getAccount($email,$pass);


		

		if(empty($result))
		{
			$error_message="Incorrect Email/Password";
			$this->load->view('/login',$error_message);
		}
		else
		{
					$session_data = array(						
						'is_loggedin' => true,
						'id'=>$result[0]->id,
						'name'=>$result[0]->name,
						'username'=>$result[0]->username,
						'email'=>$result[0]->email,
						'type'=>$result[0]->type
					);	
			// Add user data in session
		$this->session->set_userdata('logged_in', $session_data);
		redirect('main');
		}


	
	}

	function getSession()
	{
		echo json_encode($this->session->userdata['logged_in']);

	}
}