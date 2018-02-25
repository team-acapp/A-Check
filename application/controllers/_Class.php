<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class _Class extends CI_Controller {

		function __construct(){
		parent:: __construct();
		$this->load->model('class_model','claz');
		$this->load->model('student_model','student');

	}

	function editClass()
	{
		$id=$this->input->post('id');		
		$result=$this->claz->getClass($id);
		echo json_encode($result);

	}
	function submitEditClass()
	{
		$id=$this->input->post('id');
		$code=$this->input->post('code');
		$name=$this->input->post('name');
		$day=$this->input->post('day');
		$time1=$this->input->post('time1');
		$time2=$this->input->post('time2');
		$teacher=$this->input->post('teacher');
		$sem =$this->input->post('sem');
		$year=$this->input->post('year');

		$_day="";
		$a=0;
		$b=sizeof($day)-1;

		foreach($day as $d)
		{
			if($a==$b)
			{
				$_day=$_day . $d;
			}
			else
			{
				$_day=$_day . $d. "|";
			}
			$a++;
		}

		$_class=$this->claz->getClass($id);
		$preClassCode=$_class[0]->classcode . '|'. $_class[0]->classdes;

		$data=array(
						'db'=>"acapp_db",
						'table'=>"classlist",
						'fields'=>array(
							'classcode'=>$code,
							'classdes'=>$name,
							'day'=>$_day,
							'time'=>$time1,
							'time2'=>$time2,
							'sem'=>$sem,
							'year'=>$year,
							'createdby'=>$teacher),
						'parameter'=>array(
							'classid'=>$id));
		$result=$this->crud->update($data);
		if($result==1)
		{
			echo "Saved Successfuly";
			$students=$this->student->getAllStudentsViaCode($preClassCode);
			if(!empty($students))
			{
				echo json_encode($students);
				foreach($students as $s)
				{
					$ccode=explode("*", $s->classid);
					if(sizeof($ccode)>1)
					{
						for($a=0;$a<sizeof($ccode);$a++)
						{
							if($ccode[$a]==$preClassCode)
							{
								$ccode[$a]=$code."|".$name;
							}
						}

						for($b=0;$b<sizeof($ccode);$b++)
						{
							if($b==(sizeof($ccode)-1))
							{
								$newCode=$newCode.$ccode[$b];
							}
							else
							{
								$newCode=$newCode.$ccode[$b]."*";
							}
						}


					}
					else
					{
						$newCode=$code."|".$name;	
					}
					

					$data=array(
						'db'=>"acapp_db",
						'table'=>"classstud",
						'fields'=>array(
							'classid'=>$newCode),
						'parameter'=>array(
							'cid'=>$s->cid));
					$result=$this->crud->update($data);
					if($result==1)
					{
						echo "SAVED ULIT";
					}
				}
			}
			$_modules=$this->claz->getModulesviaID($preClassCode);

			if(!empty($_modules))
			{
				foreach($_modules as $m)
				{
					$newCode=$code."|".$name;
					$data=array(
						'db'=>"acapp_db",
						'table'=>"modules",
						'fields'=>array(
							'classcode'=>$newCode),
						'parameter'=>array(
							'mID'=>$m->mID));
					$result=$this->crud->update($data);
					if($result==1)
					{
						echo "SAVED";
					}
				}
			}

			$attendance=$this->claz->getAttendanceviaClass($preClassCode);
			if(!empty($attendance))
			{
				foreach($attendance as $a)
				{
					$newCode=$code."|".$name;
					$data=array(
						'db'=>"acapp_db",
						'table'=>"attendance",
						'fields'=>array(
							'classCode'=>$newCode),
						'parameter'=>array(
							'id'=>$a->id));
					$result=$this->crud->update($data);
					if($result==1)
					{
						echo "SAVED";
					}
				}
			}
			
		}
		else
		{
			echo "There was an error updating your data";
		}
	}

	function submitNewClass()
	{
		$code=$this->input->post('code');
		$name=$this->input->post('name');
		$day=$this->input->post('day');
		$time1=$this->input->post('time1');
		$time2=$this->input->post('time2');
		$teacher=$this->input->post('teacher');
		$sem=$this->input->post('sem');
		$year=$this->input->post('year');


		$_day="";
		$a=0;
		$b=sizeof($day)-1;

		foreach($day as $d)
		{
			if($a==$b)
			{
				$_day=$_day . $d;
			}
			else
			{
				$_day=$_day . $d. "|";
			}
			$a++;
		}


		$data=array(
						'db'=>"acapp_db",
						'table'=>"classlist",
						'fields'=>array(
							'classcode'=>$code,
							'classdes'=>$name,
							'day'=>$_day,
							'time'=>$time1,
							'time2'=>$time2,
							'sem'=>$sem,
							'year'=>$year,
							'createdby'=>$teacher,
							'stat'=>"web"));

		$result=$this->crud->insert($data);
		if($result==1)
		{
			echo "Saved Successfuly";
		}
		else
		{
			echo "There was an error updating your data";
		}
	}

	function deleteClass()
	{
		$id=$this->input->post('id');

				$data=array(
					'db'=>"acapp_db",
					'table'=>"classlist",						
					'parameter'=>array(
						'classid'=>$id));
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

	function getAllClasses()
	{
		$type=$this->session->userdata['logged_in']['type'];

		if($type=="admin")
		{
			$classes=$this->claz->getAllClass();
			echo json_encode($classes);
		}
		else
		{
			$classes=$this->claz->getSpecificTeachers();
			echo json_encode($classes);
		}
	}
	
	function getClassViaSem()
	{
		$type=$this->session->userdata['logged_in']['type'];
		$sem=$this->input->post('sem');
		if($type=="admin")
		{
			$classes=$this->claz->getAllClassViaSem($sem);
			echo json_encode($classes);
			
		}
		else
		{
			$classes=$this->claz->getSpecificTeachersViaSem($sem);
			echo json_encode($classes);
			
		}
		
	}
	function getClassViaYear()
	{
		$type=$this->session->userdata['logged_in']['type'];
		$year=$this->input->post('year');
		if($type=="admin")
		{
			$classes=$this->claz->getAllClassViaYear($year);
			echo json_encode($classes);
			
		}
		else
		{
			$classes=$this->claz->getSpecificTeachersViaYear($year);
			echo json_encode($classes);
			
		}
		
	}
	


}