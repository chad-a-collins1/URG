<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main_model extends CI_Model {
	
	public function get_data($table,$where=null) {
		$this->db->select('*');
		$this->db->from($table);
		if($where!=null) {
			foreach($where as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}
	
	public function insert_data($table,$data) {
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function viewquestiontype($tierid) {
		//echo "ghg";
		//exit;
        $s ="select questions.*,question_type.qtype,questioncategories.categorytext
		                     from questions
							  join question_type
							 on questions.questiontype=question_type.id 
							 join questioncategories
							on questions.questioncategoryid=questioncategories.categoryid 
							
							where questions.servicetype = 7 and questions.tierid='".$tierid."' ORDER BY questions.questioncategoryid, questions.question_order ASC ";
		//echo $s;
		$q=$this->db->query($s);
		return $q->result();
	}
	public function viewanswer($tierid,$facilityid) 
	{
	   $qry = "select answers.*, question_type.*, questions.*, questions.tierid as qtierid,questioncategories.categorytext 
		       from answers 
			   join questions on answers.questionid = questions.questionid 
			   JOIN question_type on questions.questiontype = question_type.id  
			   join questioncategories on questions.questioncategoryid=questioncategories.categoryid 
			   where answers.facilityid = '".$facilityid."' and answers.tierid = '".$tierid."' ORDER BY questions.questioncategoryid, questions.question_order ASC ";
	
		$res = $this->db->query($qry);
		return $res->result();
	}
	public function getfacility($user_id) {
		$q=$this->db->query("select * from facilities where userid='".$user_id."'");
		return $q->result();
	}
	
	public function update_data($table,$data,$where)
	{
		foreach($where as $key=>$value){
			$this->db->where($key,$value);
		}		
		$data = $this->db->update($table, $data); 
		$this->db->last_query();
		
		return $data;
		//print_r($data);
		exit;
		
	}
	function updatedata($id,$data)
	{
		$this->db->where('id', $id);
		$rs = $this->db->update('userfacilities', $data);
		return $rs;
    }
	
	function getPaymentHistory() {
		$qry = "SELECT facility_payment.*, users.username, facilities.facilityname, tiers.description from facility_payment join users on facility_payment.userid = users.userid join facilities on facility_payment.facilityid = facilities.facilityid join tiers on facility_payment.tierid = tiers.tierid ORDER BY id DESC";
		$res = $this->db->query($qry);
		return $res->result_array();
	}
}
