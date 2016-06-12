<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_wh_m extends CI_Model {

	public function getAll($limit,$page){
		$this->db->limit($limit, $page);
		$this->db->select("*");
		$query = $this->db->get("Inventory_wh");
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
		// Other

	public function countAll(){
		$result = $this->db->count_all('Inventory_wh');
		return $result;
	}

}
