<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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

	public function index()
	{
		$data['pages']="index.html";
		$this->load->view('template/_layout',$data);
	}

	function getSession(){
		echo json_encode($this->session->userdata['logged_in']);

	}

	public function login()
	{
		$session_data = array(						
						'is_loggedin' => true,
					);	
			// Add user data in session
		$this->session->set_userdata('logged_in', $session_data);
		redirect("default");
	}

	public function teachers_index()
	{

			$data['teachers']=$this->teachers->getAllTeachers();
		

		$data['pages']="teachers/teachers_index.php";
		$this->load->view('template/_layout',$data);
	}

	public function class_index()
	{
		$type=$this->session->userdata['logged_in']['type'];

		if($type=="admin")
		{
		$data['class']=$this->_class->getAllClass();
		}
		else
		{
			$data['class']=$this->_class->getSpecificTeachers();
		}
		
		$data['pages']="_class/class_index.php";
		$this->load->view('template/_layout',$data);
	}

	public function student_index()
	{
		$type=$this->session->userdata['logged_in']['type'];
		if($type=="admin")
		{
			$classes=$this->_class->getAllClass();
			$data['classes']=$classes;
			$_classid=$classes[0]->classcode."|". $classes[0]->classdes;
			$students=$this->student->getStudents($_classid);
			$data['students']=$students;
		}
		else
		{
			$classes=$this->_class->getSpecificTeachers();
			$data['classes']=$classes;
			//echo json_encode($classes);
			$_classid=$classes[0]->classcode."|". $classes[0]->classdes;
			$students=$this->student->getStudents($_classid);
			//echo json_encode($students);
			$data['students']=$students;
		}
		$data['pages']="students/students_index.php";
		$this->load->view('template/_layout',$data);
	}
	public function modules_index()
	{
		$data['pages']="modules/module_index.php";
		$type=$this->session->userdata['logged_in']['type'];
		
		

		if($type=="admin")
		{
		$result=$this->teachers->getUploaded();
		$data['uploads']=$result;
		$data['class']=$this->_class->getAllClass();
		}
		else
		{
		$result=$this->teachers->getUploadedwithTeacher();
		$data['uploads']=$result;
		$data['class']=$this->_class->getSpecificTeachers();
		}
		$this->load->view('template/_layout',$data);
	}
	
	public function about_index()
	{
		$data['pages']="about/about_index.php";
		$this->load->view('template/_layout',$data);
	}
	
	
	
	
}
