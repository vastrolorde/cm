<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function getAll($limit,$page){
		$this->db->limit($limit, $page);
		$this->db->select("*");
		$query = $this->db->get("product");
		$this->db->order_by('product_family', 'DESC');

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
		$this->db->where("product_id",$id);
		$query = $this->db->get("product");
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('product',$data);
	}

	public function update($data,$id){
		$this->db->where('product_id',$id);
		$this->db->update('product',$data);
	}

	public function delete($id){
		$this->db->where('product_id',$id);
		$this->db->delete('product');
	}

	// Other

	public function countAll(){
		$result = $this->db->count_all('product');
		return $result;
	}


	public function lookup($keyword){
		$this->db->select('product_name');
		$this->db->from('product');
		$this->db->like('product_name',$keyword);
		return $this->db->get()->result();
	}


}
