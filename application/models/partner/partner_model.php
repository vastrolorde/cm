<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_model extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("partner");
		return $result = $query->result();
	}

	public function get($id,$tbl){
		$this->db->select("*");
		$this->db->where("id",$id);
		$query = $this->db->get($tbl);
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('partner',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('partner',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('partner');
	}

	// Other

	public function bank(){
		$this->db->select();
		$query = $this->db->get('bank');
		return $result = $query->result_array();
	}

}
