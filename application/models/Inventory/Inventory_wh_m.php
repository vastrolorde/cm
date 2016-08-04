<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_wh_m extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("Inventory_wh");
		$this->db->order_by('id', 'ASC');

		return $result = $query->result();
	}

	public function get($id){
		$this->db->select("*");
		$this->db->where("id",$id);
		$query = $this->db->get('Inventory_wh');
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('Inventory_wh',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('Inventory_wh',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('Inventory_wh');
	}

	/******			Others			******/

	//Count all Inventory_wh row
	public function countAll(){
		$result = $this->db->count_all('Inventory_wh');
		return $result;
	}


	//query all Inventory_wh
	public function wh_all(){
		$this->db->select('*');
		$this->db->from('Inventory_wh');
		$result = $this->db->get();
		return $result->result_array();
	}

}
