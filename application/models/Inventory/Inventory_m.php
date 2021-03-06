<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_m extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("Inventory_move");
		$this->db->order_by('id', 'ASC');

		return $result = $query->result();
	}

	public function get($id){
		$this->db->select("ivtry.id,ivtry.refdoc_id,ivtry.create_date,ivtry.update_date,ivtry.invent_move_Date,ivtry.invent_move_type,ivtry.invent_move_status,ivtry.invent_move_wh");

		$this->db->where("ivtry.id",$id);
		$this->db->from("Inventory_move as ivtry");
		$query = $this->db->get();
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

	/******			Product Transaction			******/


	//Inventory Movement
	public function qry_tr($data){
		$this->db->select("tr.id,tr.inventory_move_id,tr.product_id,tr.amount,pro.product_id,pro.product_name,pro.product_weight");
		$this->db->where('inventory_move_id',$data);
		$this->db->from('Inventory_move_tr as tr');
		$this->db->join('product as pro','tr.product_id = pro.product_id');
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function add_tr($data){
		$this->db->insert('inventory_move_tr',$data);
	}
	
	public function update_tr($id,$data){
		$this->db->where('id',$id);
		$this->db->update('inventory_move_tr',$data);
	}

	public function del_tr($id){
		$this->db->where('id',$id);
		$this->db->delete('inventory_move_tr');
	}

	/******			Others			******/
	//Count all Transaction
	public function countAll(){
		$result = $this->db->count_all('Inventory_move');
		return $result;
	}

	// Update transaction status
	public function update_transaction_status($data,$id){
		$this->db->where('inventory_move_id',$id);
		$this->db->update('inventory_move_tr',$data);
	}

}
