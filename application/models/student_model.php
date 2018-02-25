<?php

Class student_model extends CI_Model {


	function __construct(){
		parent:: __construct();

	}
	

	function getStudents($id)
	{
		$this->db->select('*');
		$this->db->from('classstud');
		$this->db->like('classid',$id);
		$query=$this->db->get();
		return $query->result();
	}

	function getAllStudents()
	{
		$this->db->select('*');
		$this->db->from('classstud');
		$query=$this->db->get();
		return $query->result();
	}
	function getStudentsViaID($id)
	{
		$this->db->select('*');
		$this->db->from('classstud');
		$this->db->where('cid',$id);
		$query=$this->db->get();
		return $query->result();
	}
	function getStudentsViaSID($id)
	{
		$this->db->select('*');
		$this->db->from('classstud');
		$this->db->where('sID',$id);
		$query=$this->db->get();
		return $query->result();
	}
	function getAllStudentsViaCode($id)
	{
		$this->db->select('*');		
		$this->db->from('classstud');
		$this->db->like('classid',$id);
		$query=$this->db->get();
		return $query->result();
		

	}

	function getAttendanceviaSID($id)
	{
		$this->db->select('*');		
		$this->db->from('attendance');
		$this->db->like('sID',$id);
		$query=$this->db->get();
		return $query->result();
	}
	
}