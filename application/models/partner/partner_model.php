<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_model extends CI_Model {

	public function getAll($limit,$page){
		$this->db->limit($limit, $page);
		$this->db->select("*");
		$query = $this->db->get("partner");
		$this->db->order_by('id', 'DESC');

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
		$query = $this->db->get('partner');
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

	public function countAll(){
		$result = $this->db->count_all('partner');
		return $result;
	}
	
	public function bank(){
		$this->db->select();
		$query = $this->db->get('bank');
		return $result = $query->result_array();
	}

	public function lookup($keyword){
		// $this->db->query('SELECT partner_name FROM partner WHERE partner_name LIKE '.$keyword);
		$this->db->select('partner_name');
		$this->db->from('partner');
		$this->db->like('partner_name',$keyword);
		return $this->db->get()->result();
	}

}
