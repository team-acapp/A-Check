<?php

Class account_model extends CI_Model {


	function __construct(){
		parent:: __construct();

	}

	function getAccount($email,$pass)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('password',$pass);
		$query=$this->db->get();
		return $query->result();
	}
}
