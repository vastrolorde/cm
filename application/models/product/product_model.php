<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("product");
		$this->db->order_by('product_family', 'DESC');
		return $result = $query->result();

	}

	public function get($id){
		$this->db->select("*");
		$this->db->where("product_id",$id);
		$query = $this->db->get("product");
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('product',$data);
	}

	public function update($data,$data2,$id){
		$this->db->where('product_id',$id);
		$this->db->update('product',$data);
	}

	public function delete($id){
		$this->db->where('product_id',$id);
		$this->db->delete('product');
	}

	/******			Others			******/
	//Count all Transaction
	public function countAll(){
		$result = $this->db->count_all('product');
		return $result;
	}

	//Autocomplete product Lookup
	public function lookup($keyword){
		$this->db->select();
		$this->db->from('product');
		$this->db->like('product_id',$keyword);
		return $this->db->get()->result();
	}

	//query all product
	public function product_all(){
		$this->db->select('*');
		$this->db->from('product');
		$result = $this->db->get();
		return $result->result_array();
	}

}
