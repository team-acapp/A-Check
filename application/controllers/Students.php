<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

		function __construct(){
		parent:: __construct();
		$this->load->model('student_model','student');
		$this->load->model('class_model','_class');

	}

	function changeContent()
	{
		
		$class=$this->input->post('class');

		$type=$this->session->userdata['logged_in']['type'];
		if($type=="admin")
		{
			$classes=$this->_class->getAllClass();
			$data['classes']=$classes;
			$result=$this->student->getStudents($class);
			$data['students']=$result;
		}
		else
		{
			$classes=$this->_class->getSpecificTeachers();
			$data['classes']=$classes;
			$result=$this->student->getStudents($class);
			$data['students']=$result;
		}
		$data['curclass']=$class;
		$this->load->view('students/students_index.php',$data);

	}

	function editStudents()
	{
		$id=$this->input->post('id');
		$result=$this->student->getStudentsViaID($id);
		echo json_encode($result);

	}

	function submitEditStudents()
	{
		$name=$this->input->post('name');
		$sid=$this->input->post('sid');
		$id=$this->input->post('id');
		$Stclass=$this->input->post('class');
		$student=$this->student->getStudentsViaID($id);
		$password=$student[0]->spass;
		$pre_sid=$student[0]->sID;

		$_class="";
		$a=0;
		$b=sizeof($Stclass)-1;

		foreach($Stclass as $d)
		{
			if($a==$b)
			{
				$_class=$_class . $d;
			}
			else
			{
				$_class=$_class . $d. "*";
			}
			$a++;
		}

		$pre_code=$student[0]->sID."|".$student[0]->sname;

		if($pre_sid==$password)
		{
					$data=array(
						'db'=>"acapp_db",
						'table'=>"classstud",
						'fields'=>array(
							'sname'=>$name,
							'sID'=>$sid,
							'spass'=>$sid,
							'classid'=>$_class),
						'parameter'=>array(
							'cid'=>$id));
		}
		else
		{
			$data=array(
						'db'=>"acapp_db",
						'table'=>"classstud",
						'fields'=>array(
							'sname'=>$name,
							'classid'=>$_class,
							'sID'=>$sid),
						'parameter'=>array(
							'cid'=>$id));
		}

		$result=$this->crud->update($data);
		if($result==1)
		{
			echo "SAVED SUCCESSFULLY";
			$attendance=$this->student->getAttendanceviaSID($pre_code);

			if(!empty($attendance))
			{
				foreach($attendance as $a)
				{
					$newCode=$sid."|".$name;
					$data=array(
						'db'=>"acapp_db",
						'table'=>"attendance",
						'fields'=>array(
							'sID'=>$newCode),
						'parameter'=>array(
							'id'=>$a->id));
					$result=$this->crud->update($data);
					if($result==1)
					{
						echo "SAVED ULIT";
					}					
				}
			}


		}
		else
		{
			echo "THERE WAS A PROBLEM IN UPDATING YOUR DATA";
		}

	}
	function saveNewStudent()
	{
		$name=$this->input->post('name');
		$sid=$this->input->post('sid');
		$Stclass=$this->input->post('class');

		$_class="";
		$a=0;
		$b=sizeof($Stclass)-1;

		foreach($Stclass as $d)
		{
			if($a==$b)
			{
				$_class=$_class . $d;
			}
			else
			{
				$_class=$_class . $d. "*";
			}
			$a++;
		}

				$data=array(
						'db'=>"acapp_db",
						'table'=>"classstud",
						'fields'=>array(
							'sname'=>$name,
							'sID'=>$sid,
							'classid'=>$_class,
							'stat'=>'web',
							'spass'=>$sid));
			$result=$this->crud->insert($data);
			if($result ==1)
		{
			echo "SAVED SUCCESSFULLY";
		}
		else
		{
			echo "THERE WAS A PROBLEM IN UPDATING YOUR DATA";
		}	
	}

	function deleteStudent()
	{
		$id=$this->input->post('id');
				$data=array(
					'db'=>"acapp_db",
					'table'=>"classstud",						
					'parameter'=>array(
						'cid'=>$id));
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
}
