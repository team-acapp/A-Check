<?php

Class class_model extends CI_Model {


	function __construct(){
		parent:: __construct();

	}

	function getAllClass()
	{
		$this->db->select('*');
		$this->db->from('classlist');
		$query=$this->db->get();
		return $query->result();
	}
	function getAllClassViaSem($sem)
	{
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('sem',$sem);
		$query=$this->db->get();
		return $query->result();
	}
	function getAllClassViaYear($year)
	{
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('year',$year);
		$query=$this->db->get();
		return $query->result();
	}	

	function getClass($id)
	{
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('classid',$id);
		$query=$this->db->get();
		return $query->result();
	}

	function getSpecificTeachers()
	{
		$teacher=$this->session->userdata['logged_in']['username'] . "|".$this->session->userdata['logged_in']['name'];
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('createdby',$teacher);
		$query=$this->db->get();
		return $query->result();

	}
	function getSpecificTeachersViaSem($sem)
	{
		$teacher=$this->session->userdata['logged_in']['username'] . "|".$this->session->userdata['logged_in']['name'];
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('createdby',$teacher);
		$this->db->where('sem',$sem);
		$query=$this->db->get();
		return $query->result();

	}
	function getSpecificTeachersViaYear($year)
	{
		$teacher=$this->session->userdata['logged_in']['username'] . "|".$this->session->userdata['logged_in']['name'];
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('createdby',$teacher);
		$this->db->where('year',$year);
		$query=$this->db->get();
		return $query->result();

	}	
	function getClassviaCode($code)
	{
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('classcode',$code);
		$query=$this->db->get();
		return $query->result();
	}

	function getClassviaUsername($id)
	{
		$this->db->select('*');
		$this->db->from('classlist');
		$this->db->where('createdby',$id);
		$query=$this->db->get();
		return $query->result();

	}

	function getAttendanceviaClass($id)
	{
		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('classCode',$id);
		$query=$this->db->get();
		return $query->result();
	}

	function getModulesviaID($id)
	{
		$this->db->select('*');
		$this->db->from('modules');
		$this->db->where('classcode',$id);
		$query=$this->db->get();
		return $query->result();		
	}





}