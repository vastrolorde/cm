<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("product");
		return $result = $query->result();
	}

	public function get($id,$tbl){
		$this->db->select("*");
		$this->db->where("product_id",$id);
		$query = $this->db->get($tbl);
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('product',$data);
	}

	public function create_batch($data2){
		$this->db->insert_batch('product_attr_transaction',$data2);
	}

	public function update(){}
	public function delete(){}

}
