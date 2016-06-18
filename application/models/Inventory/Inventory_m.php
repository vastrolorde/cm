<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_m extends CI_Model {

	public function getAll($limit, $page){
		$this->db->limit($limit, $page);
		$this->db->select("*");
		$query = $this->db->get("Inventory_move");
		$this->db->order_by('id', 'ASC');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

		return false;

	}

	public function get($id){
		$this->db->select("*");
		$this->db->where("id",$id);
		$query = $this->db->get('Inventory_move');
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('Inventory_move',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('Inventory_move',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('Inventory_move');
	}


	/******			Others			******/
	//Count all Transaction
	public function countAll(){
		$result = $this->db->count_all('Inventory_move');
		return $result;
	}

	//partner data
	public function partner($data){
		if($data == 'all'){
			$this->db->select('*');
			$this->db->from('partner');
		}else{
			$this->db->select('*');
			$this->db->from('partner');
			$this->db->where('id',$data);
		}

		$result = $this->db->get();
		return $result->result_array();
	}


	public function product($data){
		if($data == 'all'){
			$this->db->select('*');
			$this->db->from('product');
		}else{
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where('id',$data);
		}

		$result = $this->db->get();
		return $result->result_array();
	}


	public function warehouse($data){
		if($data == 'all'){
			$this->db->select('*');
			$this->db->from('inventory_wh');
		}else{
			$this->db->select('*');
			$this->db->from('inventory_wh');
			$this->db->where('id',$data);
		}

		$result = $this->db->get();
		return $result->result_array();
	}


}
