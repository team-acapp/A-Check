<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

		function __construct(){
		parent:: __construct();
		$this->load->model('teacher_model','teachers');
		$this->load->model('class_model','_class');
		$this->load->model('student_model','student');
		$this->load->model('attendance_model','att');
		
		if(!($this->session->userdata['logged_in']))
		{
			redirect('login');
		}
	}

		function getAttendance()
		{
		$type=$this->session->userdata['logged_in']['type'];
		
			if($type=="admin")
		{
			$_1class=$this->_class->getAllClass();
		}
		else
		{
			$_1class=$this->_class->getSpecificTeachers();
		}
		$_classcode=$_1class[0]->classcode."|".$_1class[0]->classdes;
		
			$result=$this->att->getAttendance($_classcode);
			
			$ar=[];
			$name=[];
			foreach($result as $r)
			{
				if(in_array($r->date,$ar))
				{

				}
				else
				{
					$ar[]=$r->date;
				}

				if(in_array($r->sID,$name))
				{

				}
				else
				{
					$name[]=$r->sID;
				}



				
				
			}

			for($a=0;$a<sizeof($name);$a++)
			{
				${$name[$a]}=[];
			}


			for($i=0;$i<sizeof($ar);$i++)
			{
				for($j=0;$j<sizeof($name);$j++)
				{
					$a="";
					$res=$this->att->getAttendancebyDate($name[$j],$ar[$i]);
					if(empty($res))
					{
						$a="NO RECORD";
					}
					else
					{
						$a=$res[0]->status." - ".$res[0]->note;						
					}
					${$name[$j]}[]=$a;
				}
			}

			$data['dates']=$ar;
			

			for($a=0;$a<sizeof($name);$a++)
			{
				
				$data["student".($a+1)]=(${$name[$a]});
				$data['names']=($name);
			}

			
			$data['pages']='attendance/attendance_index.php';
			$data['result']=$result;
		$type=$this->session->userdata['logged_in']['type'];
		$result=$this->teachers->getUploaded();
				if($type=="admin")
		{
		$data['class']=$this->_class->getAllClass();
		}
		else
		{
			$data['class']=$this->_class->getSpecificTeachers();
		}
			$this->load->view('template/_layout',$data);
		}

		function getAtt()
		{
			$dt1=$this->input->post('date1');
			$dt2=$this->input->post('date2');
			$classz=$this->input->post('class');

			$result=$this->att->getAttendancewithClass($dt1,$dt2,$classz);
			$ar=[];
			$name=[];
			foreach($result as $r)
			{
				if(in_array($r->date,$ar))
				{

				}
				else
				{
					$ar[]=$r->date;
				}

				if(in_array($r->sID,$name))
				{

				}
				else
				{
					$name[]=$r->sID;
				}



				
				
			}

			for($a=0;$a<sizeof($name);$a++)
			{
				${$name[$a]}=[];
			}


			for($i=0;$i<sizeof($ar);$i++)
			{
				for($j=0;$j<sizeof($name);$j++)
				{
					$a="";
					$res=$this->att->getAttendancebyDate($name[$j],$ar[$i]);
					if(empty($res))
					{
						$a="none";
					}
					else
					{
						$a=$res[0]->status." - ".$res[0]->note;					
					}
					${$name[$j]}[]=$a;
				}
			}

			$data['dates']=$ar;
			

			for($a=0;$a<sizeof($name);$a++)
			{
				
				$data["student".($a+1)]=(${$name[$a]});
				$data['names']=($name);
			}

			
			
			$data['result']=$result;
			$data['curclass']=$classz;
		$type=$this->session->userdata['logged_in']['type'];
		
			if($type=="admin")
		{
			$data['class']=$this->_class->getAllClass();
		}
		else
		{
			$data['class']=$this->_class->getSpecificTeachers();
		}
			$this->load->view('attendance/attendance_ajax',$data);
		
			
		




	
}
}