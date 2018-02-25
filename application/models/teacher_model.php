<?php

Class teacher_model extends CI_Model {


	function __construct(){
		parent:: __construct();

	}

	function getAllTeachers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('type',"teacher");
		$query=$this->db->get();
		return $query->result();
	}

	function getTeacher($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('type',"teacher");
		$this->db->where('username',$id);
		$query=$this->db->get();
		return $query->result();
	}

	function getAccount($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$id);
		$query=$this->db->get();
		return $query->result();
	}
	function getTeacherviaID($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('type',"teacher");
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->result();
	}
	function getType($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->result();
	}
	function getUploaded()
	{
		$this->db->select('*');
		$this->db->from('modules');
		$query=$this->db->get();
		return $query->result();
	}
	function getUploadedwithTeacher()
	{
		$teacher=$this->session->userdata['logged_in']['username'] . "|".$this->session->userdata['logged_in']['name'];
		$this->db->select('*');
		$this->db->from('modules');
		$this->db->where('createdby',$teacher);
		$query=$this->db->get();
		return $query->result();

	}

	function getUploadedMobile($teacher)
	{		
		$this->db->select('*');
		$this->db->from('modules');
		$this->db->where('createdby',$teacher);
		$query=$this->db->get();
		return $query->result();

	}


}