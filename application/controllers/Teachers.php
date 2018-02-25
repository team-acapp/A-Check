<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers extends CI_Controller {

		function __construct(){
		parent:: __construct();
		$this->load->model('teacher_model','teachers');
		$this->load->model('class_model','claz');

	}
	
	public function editTeachers()
	{
		$id=$this->input->post('id');
		$result=$this->teachers->getTeacherViaID($id);
		echo json_encode($result);
	}

	public function getUsers()
	{
		$username=$this->input->post('username');
		$result=$this->teachers->getAccount($username);
		echo json_encode($result);
	}

	public function getAllTeachers()
	{
		$result=$this->teachers->getAllTeachers();
		echo json_encode($result);
	}

	public function submitEditTeachers()
	{
		$name=$this->input->post('name');
		$username=$this->input->post('username');
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$id=$this->input->post('id');

		$result=$this->teachers->getType($id);
		$preID=$result[0]->username."|".$result[0]->name;



		if($password!="")
		{
			$password=md5($password);
				$data=array(
						'db'=>"acapp_db",
						'table'=>"users",
						'fields'=>array(
							'name'=>$name,
							'username'=>$username,
							'email'=>$email,
							'password'=>$password),
						'parameter'=>array(
							'id'=>$id));
		}
		else
		{
				$data=array(
						'db'=>"acapp_db",
						'table'=>"users",
						'fields'=>array(
							'name'=>$name,
							'username'=>$username,
							'email'=>$email),
						'parameter'=>array(
							'id'=>$id));
		}

	

		$result=$this->crud->update($data);

		if($result==1)
		{
			$_classes=$this->claz->getClassviaUsername($preID);
			if(!empty($_classes))
			{
				foreach($_classes as $c)
				{
					$newCode=$username."|".$name;
					echo $newCode;
					$data=array(
						'db'=>"acapp_db",
						'table'=>"classlist",
						'fields'=>array(
							'createdby'=>$newCode),
						'parameter'=>array(
							'classid'=>$c->classid));
					$result=$this->crud->update($data);
					if($result==1)
					{
						echo "SAVED ULIT";
					}
				}

				$_modules=$this->teachers->getUploadedwithTeacher($preID);
				if(!empty($_modules))
				{
					foreach($_modules as $m)
					{
						$newCode=$username."|".$name;
						echo $newCode;
						$data=array(
							'db'=>"acapp_db",
							'table'=>"modules",
							'fields'=>array(
								'createdby'=>$newCode),
							'parameter'=>array(
								'mID'=>$m->mID));
						$result=$this->crud->update($data);						
					}
				}
			}
			echo "Saved Successfuly";
		}
		else
		{
			echo "There was an error updating your data";
		}


	}

	public function saveNewTeacher()
	{
		$name=$this->input->post('name');
		$username=$this->input->post('username');
		$email=$this->input->post('email');
		$password=md5($this->input->post('pass'));

		

		$data=array(
						'db'=>"acapp_db",
						'table'=>"users",
						'fields'=>array(
							'name'=>$name,
							'username'=>$username,
							'email'=>$email,
							'stat'=>'web',
							'type'=>'teacher',
							'password'=>$password));

		$result= $this->crud->insert($data);
		if($result == 1)
		{
			echo "Saved Successfuly";
		}
		else
		{
			echo "There was an error saving your data";
		}
	}

	public function deleteTeacher()
	{
		$id=$this->input->post('id');


		$data=array(
					'db'=>"acapp_db",
					'table'=>"users",						
					'parameter'=>array(
						'id'=>$id));
					$result=$this->crud->delete($data);		

					if($result == 1 )
					{
						echo "Deleted Successfully";
					}
					else
					{
						echo "There was an error deleting your data";
					}
	}

	public function submitEditAccount()
	{
		$name=$this->input->post('name');
		$username=$this->input->post('username');
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$id=$this->input->post('id');

		$result=$this->teachers->getType($id);
		$type=$result[0]->type;
		$preID=$result[0]->username."|".$result[0]->name;
		


		if($password!="")
		{
			$password=md5($password);
				$data=array(
						'db'=>"acapp_db",
						'table'=>"users",
						'fields'=>array(
							'name'=>$name,
							'username'=>$username,
							'email'=>$email,
							'password'=>$password),
						'parameter'=>array(
							'id'=>$id));
		}
		else
		{
				$data=array(
						'db'=>"acapp_db",
						'table'=>"users",
						'fields'=>array(
							'name'=>$name,
							'username'=>$username,
							'email'=>$email),
						'parameter'=>array(
							'id'=>$id));
		}

	

		$result=$this->crud->update($data);

		if($result==1)
		{
			$_classes=$this->claz->getClassviaUsername($preID);
			if(!empty($_classes))
			{
				foreach($_classes as $c)
				{
					$newCode=$username."|".$name;
					echo $newCode;
					$data=array(
						'db'=>"acapp_db",
						'table'=>"classlist",
						'fields'=>array(
							'createdby'=>$newCode),
						'parameter'=>array(
							'classid'=>$c->classid));
					$result=$this->crud->update($data);
					if($result==1)
					{
						echo "SAVED ULIT";
					}
				}
			}

			echo "Saved Successfuly";
						$session_data = array(						
						'is_loggedin' => true,
						'id'=>$id,
						'name'=>$name,
						'username'=>$username,
						'email'=>$email,
						'type'=>$type
					);	
			// Add user data in session
		$this->session->set_userdata('logged_in', $session_data);
		}
		else
		{
			echo "There was an error updating your data";
		}

	}

}
