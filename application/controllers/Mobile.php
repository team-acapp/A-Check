<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

		function __construct(){
		parent:: __construct();
		$this->load->model('teacher_model','teachers');
		$this->load->model('class_model','_class');
		$this->load->model('student_model','students');
		$this->load->model('attendance_model','attendance');




	}

	function SyncClass()
	{
		$raw = $this->input->post();
		$data = json_decode($raw['PostData']);

		echo json_encode($data);


		if($data->stat=="mob")
		{

		$datum=array(
						'db'=>"acapp_db",
						'table'=>"classlist",
						'fields'=>array(
							'classcode'=>$data->classCode,
							'classdes'=>$data->className,
							'day'=>$data->day,
							'time'=>$data->timeIN,
							'time2'=>$data->timeOUT,
							'createdby'=>$data->teacherID,
							'stat'=>"web"));
		$result=$this->crud->insert($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";

		}
		else
		{
			echo "There was an error transfering your data";
		}
		}
		elseif ($data->stat=="web-edit")
		{
		$pre_class=$this->_class->getClassviaCode($data->classCode);
		$preClassCode=$pre_class[0]->classcode . '|'. $pre_class[0]->classdes;
		echo "ID". $preClassCode;

			$datum=array(
				'db'=>"acapp_db",
				'table'=>"classlist",
				'fields'=>array(
					'classcode'=>$data->classCode,
					'classdes'=>$data->className,
					'day'=>$data->day,
					'time'=>$data->timeIN,
					'time2'=>$data->timeOUT,
					'createdby'=>$data->teacherID,
					'stat'=>"web"),
				'parameter'=>array(
					'classcode'=>$data->classCode));
		$newCode="";
		$prenewCode=$data->classCode."|".$data->className;
		$result=$this->crud->update($datum);
		if($result == 1)
		{
		echo "Data was successfuly transfered";


		$students=$this->students->getAllStudentsViaCode($preClassCode);
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
								$ccode[$a]=$prenewCode;
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
						$newCode=$prenewCode;
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
			$_modules=$this->_class->getModulesviaID($preClassCode);

			if(!empty($_modules))
			{
				foreach($_modules as $m)
				{
					$newCode=$prenewCode;
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

			$attendance=$this->_class->getAttendanceviaClass($preClassCode);
			if(!empty($attendance))
			{
				foreach($attendance as $a)
				{
					$newCode=$prenewCode;
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
			echo "There was an error transfering your data";
		}

		}
		elseif($data->stat=="web-delete")
		{
			$datum=array(
				'db'=>"acapp_db",
				'table'=>"classlist",
				'parameter'=>array(
					'classcode'=>$data->classCode));
			$result=$this->crud->delete($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";

		}
		else
		{
			echo "There was an error transfering your data";
		}


		}

	}

	function PostClass()
	{
		$result=$this->_class->getAllClass();
		echo json_encode($result);
	}

	function SyncTeachers()
	{
		$raw = $this->input->post();
		$data = json_decode($raw['PostData']);

		echo json_encode($data);



		if($data->stat=="mob")
		{

		$datum=array(
						'db'=>"acapp_db",
						'table'=>"users",
						'fields'=>array(
							'name'=>$data->name,
							'username'=>$data->username,
							'email'=>$data->email,
							'stat'=>'web',
							'type'=>'teacher',
							'password'=>($data->password)));

		$result=$this->crud->insert($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";

		}
		else
		{
			echo "There was an error transfering your data";
		}
		}
		elseif ($data->stat=="web-edit")
		{

		$result=$this->teachers->getAccount($data->username);
		$preID=$result[0]->username."|".$result[0]->name;
			$password=($data->password);
				$datum=array(
						'db'=>"acapp_db",
						'table'=>"users",
						'fields'=>array(
							'name'=>$data->name,
							'username'=>$data->username,
							'email'=>$data->email,
							'password'=>$password),
						'parameter'=>array(
							'username'=>$data->username));
		$result=$this->crud->update($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";
			$newCode=$data->username."|".$data->name;
			$_classes=$this->_class->getClassviaUsername($preID);
			if(!empty($_classes))
			{
				
				foreach($_classes as $c)
				{
					
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
			echo "HELLO".$preID;
			$_modules=$this->teachers->getUploadedMobile($preID);
				if(!empty($_modules))
				{
					
					foreach($_modules as $m)
					{
						
						echo "NEWCODE".$newCode;
						$data=array(
							'db'=>"acapp_db",
							'table'=>"modules",
							'fields'=>array(
								'createdby'=>$newCode),
							'parameter'=>array(
								'mID'=>$m->mID));
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
			echo "There was an error transfering your data";
		}

		}
	}
		function PostTeachers()
	{
		$result=$this->teachers->getAllTeachers();
		echo json_encode($result);
	}

	function SyncStudents()
	{
		$raw = $this->input->post();
		$data = json_decode($raw['PostData']);

		echo json_encode($data);



		if($data->stat=="mob")
		{

		$datum=array(
						'db'=>"acapp_db",
						'table'=>"classstud",
						'fields'=>array(
							'sname'=>$data->sname,
							'sID'=>$data->sID,
							'classid'=>$data->classid,
							'stat'=>'web',
							'spass'=>$data->sID));

		$result=$this->crud->insert($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";

		}
		else
		{
			echo "There was an error transfering your data";
		}
		}
		elseif ($data->stat=="web-edit")
		{

		$pre_code=$student[0]->sID."|".$student[0]->sname;
		$student=$this->students->getStudentsViaSID($data->sID);
		$password=$student[0]->spass;
		$pre_sid=$student[0]->sID;
		$pre_code=$student[0]->sID."|".$student[0]->sname;

					$datum=array(
						'db'=>"acapp_db",
						'table'=>"classstud",
						'fields'=>array(
							'sname'=>$data->sname,
							'sID'=>$data->sID,
							'spass'=>$data->spass,
							'classid'=>$data->classid),
						'parameter'=>array(
							'sID'=>$data->sID));
		
		$result=$this->crud->update($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";
			$attendance=$this->students->getAttendanceviaSID($pre_code);

			if(!empty($attendance))
			{
				foreach($attendance as $a)
				{
					$newCode=$data->sID."|".$data->sname;
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
			echo "There was an error transfering your data";
		}

		}
				elseif($data->stat=="web-delete")
		{
			$datum=array(
				'db'=>"acapp_db",
				'table'=>"classstud",
				'parameter'=>array(
					'sID'=>$data->sID));
			$result=$this->crud->delete($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";

		}
		else
		{
			echo "There was an error transfering your data";
		}


		}		
	}

	function PostStudents()
	{
		$result=$this->students->getAllStudents();
		echo json_encode($result);

	}

	function SyncAttendance()
	{
		$raw = $this->input->post();
		$data = json_decode($raw['PostData']);
		echo "ATTENDANCE";
		echo json_encode($data);



		if($data->stat=="mob")
		{

		$datum=array(
						'db'=>"acapp_db",
						'table'=>"attendance",
						'fields'=>array(
							'sID'=>$data->sID,
							'date'=>$data->date,
							'stat'=>"web",
							'status'=>$data->status,
							'classCode'=>$data->classCode,
							'note'=>$data->note));

		$result=$this->crud->insert($datum);
		if($result == 1)
		{
			echo "Data was successfuly transfered";

		}
		else
		{
			echo "There was an error transfering your data";
		}
		}
	
	}

	function PostAttendance()
	{
		$result=$this->attendance->getAllAttendance();
		echo json_encode($result);
	}

	function PostModules()
	{
		$result=$this->teachers->getUploaded();
		echo json_encode($result);
	}

	function sample()
	{
		$result=$this->attendance->getAttendance();
		echo json_encode($result);
	}
}