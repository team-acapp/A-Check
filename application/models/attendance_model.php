<?php

Class attendance_model extends CI_Model {


	function __construct(){
		parent:: __construct();

	}

	function getAttendance($classz)
	{
		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('classCode',$classz);
		$query=$this->db->get();
		return $query->result();
	}

	function getAllAttendance()
	{
		$this->db->select('*');
		$this->db->from('attendance');
		$query=$this->db->get();
		return $query->result();
	}

	function getAttendancebyDate($student,$date)
	{
		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('date',$date);
		$this->db->where('sID',$student);
		$query=$this->db->get();
		return $query->result();
	}
	function getAttendancewithClass($date1,$date2,$classz)
	{

		$this->db->select('*');
		$this->db->from('attendance');
		$this->db->where('classCode',$classz);
		$this->db->where('date <=',$date2);
		$this->db->where('date >=', $date1);
		$query=$this->db->get();
		return $query->result();
	}
}
