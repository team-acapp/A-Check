<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	
class Crud Extends CI_Model {


	function __construct(){
		parent::__construct();
		$this->dbName = $this->load->database('question_db');
	}
	//var $item	 = array();
	var $fields	 = array();
	var $param = array();
	var $operator = array();

		/* 
		-array format 
			array(
			'db'	 => 'your db',
			'table'	 =>  'table name',
			'paramters'	=>  array(				
				'CoulumnName' => 'Value',
				'ID' => 'Name',
				'Name' => 'A',
				),
			
	   */
/*
-------------------------------------------------------------------
| GET ALL DATA
-------------------------------------------------------------------
*/	
	function get($data) {

		if(array_key_exists('db', $data)) {
			$this->db = $this->load->database($data['db'] , true);
		}

		if(array_key_exists('parameter', $data)){
			
			foreach ($data['parameter'] as $key => $value) {
				$item[] = $key . " = '" .$value."'";
			}
			$query= implode(" AND ", $item);

			$sql = "SELECT * FROM  " .$data['table'].  " WHERE " .$query;

		}else{
			// if no parameters
			$sql = "SELECT * FROM " .$data['table'];
		}

			$stmt = $this->db->conn_id->prepare($sql);

			$stmt->execute();
			//return $sql;
			return $stmt->fetchAll();	
	}


	function getvalue($data){

		if(array_key_exists('db', $data)) {
			$this->db = $this->load->database($data['db'] , true);
		}

		if($data['value'] == "max"){
			$sql = "SELECT MAX(".$data['valueid'].") from ".$data['table'];
		}else {
			$sql = "SELECT MIN(".$data['valueid'].") from ".$data['table'];
		}

		$stmt = $this->db->conn_id->prepare($sql);
		$stmt->execute();

		$res = $stmt->fetchAll()[0];

		$new = (array)$res;
		$result =  implode(",", $new);

		$value = explode(",",$result);

		return $value[0];
		//return $stmt->fetchAll();

		
	}
/*
-------------------------------------------------------------------
| SAVE DATA
-------------------------------------------------------------------
*/	
	function insert($data){

		if(array_key_exists('db', $data)) { 
				if($data['db'] != 'dbdefault'){
					$this->db = $this->load->database($data['db'] , true);
				}
			 }

		if(!array_key_exists('table', $data) ) { return "No table found"; } 

		if(!array_key_exists('fields', $data)) { return "No fields Found"; }

		foreach ($data['fields'] as $key => $value) {
			$fields[] = $key ." = '".$value."'" ;
		}
		$query = implode(' , ',$fields);

		$sql = "INSERT INTO ".$data['table']." SET  " .$query;
		echo $sql;
		$stmt = $this->db->conn_id->prepare($sql);
		
				return $stmt->execute();
	}

/*
-------------------------------------------------------------------
| UPDATE DATA
-------------------------------------------------------------------
*/	

	function update($data) {

		if(array_key_exists('db', $data)) { $this->db = $this->load->database($data['db'] , true); }
		if(!array_key_exists('table', $data)) { return "No table found"; } 
		if(!array_key_exists('fields', $data)) { return "No fields Found"; }
		if(!array_key_exists('parameter', $data)) {return  "no parameter found";}

		//get fields
		foreach ($data['fields'] as $key => $value) {
			$fields[] = $key ." = '".$value."'" ;
		}
		//get paramters
		foreach ($data['parameter'] as $key => $value) {
			$param[]  = " ". $key ." = '".$value."'";
		}

		$query =  implode(',',$fields);
		$condition =  implode('AND',$param);
		$sql = "UPDATE " .$data['table']. " SET " .$query. " WHERE " .$condition; 
		$stmt = $this->db->conn_id->prepare($sql);


		return $stmt->execute();

	}

/*
-------------------------------------------------------------------
| DELETE RECORD
-------------------------------------------------------------------
*/


	function delete($data) {


		if(array_key_exists('db', $data)) { $this->db = $this->load->database($data['db'] , true); }

		if(!array_key_exists('table', $data)) { return "No table found"; } 

		if(!array_key_exists('parameter', $data)) { return "No Parameter Found"; }

		foreach ($data['parameter'] as $key => $value) {
			$parameter[] = $key . " = '".$value."'";
		}

		$query = implode(" AND ", $parameter);

		$sql = "DELETE FROM " .$data['table']. " WHERE " .$query;

		echo $sql;



		$stmt = $this->db->conn_id->prepare($sql);
		return $stmt->execute();

	}

/*
-------------------------------------------------------------------
| CHECK RECORD
-------------------------------------------------------------------
*/

	function isExist($data){

		if(array_key_exists('db', $data)) { $this->db = $this->load->database($data['db'] , true); }

		if(!array_key_exists('table', $data)) { return "No table found"; } 

		if(!array_key_exists('parameter', $data)) { 

			$sql = "SELECT * FROM ".$data['table'];

		 }else {

		 	foreach ($data['parameter'] as $key => $value) {

			$param[]  = " ". $key ." = '".$value."'";

			}
		 	$operator = implode(" AND " , $param);
		 	$sql = "SELECT * FROM " .$data['table'] . " where " .$operator;
		 }
		
		// echo $sql;
		$stmt = $this->db->conn_id->prepare($sql);

		$stmt->execute();

		
		return $stmt->rowCount();

		//return $stmt->rows();

	
	}





	// function checkRecord
/*
-------------------------------------------------------------------
| GET RECORD WITH COMMAS 
-------------------------------------------------------------------
*/	
	function fnGetCommas($data) {

		if(array_key_exists('db', $data)) {
			$this->db = $this->load->database($data['db'] , true);
		}
		if(!array_key_exists('table', $data)) { return "No table found"; } 

			if(!array_key_exists('condition', $data)) {
				$sql = "SELECT * FROM " .$data['table']. "  WHERE FIND_IN_SET(".$data['parameter']." , '".$data['fields']."' )";
			}else {
				$sql = "SELECT * FROM " .$data['table']. "  WHERE FIND_IN_SET(".$data['parameter']." , '".$data['fields']."' ) = 0";
			}
			
			$stmt = $this->db->conn_id->prepare($sql);

			$stmt->execute();
			return $stmt->fetchAll();	

	}

/*
-------------------------------------------------------------------
| GET THE LAST RECORD 
-------------------------------------------------------------------
*/


}//end of class