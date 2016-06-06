<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HR_Emp_model extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("employee_data");
		$this->db->order_by('id', 'ASC');
		return $result = $query->result();
	}

	public function get($id){
		$this->db->select("*");
		$this->db->where("id",$id);
		$query = $this->db->get('employee_data');
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('employee_data',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('employee_data',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('employee_data');
	}

	// Other

	public function bank(){
		$this->db->select();
		$query = $this->db->get('bank');
		return $result = $query->result_array();
	}

	public function lookup($keyword){
		// $this->db->query('SELECT partner_name FROM partner WHERE partner_name LIKE '.$keyword);
		$this->db->select('partner_name');
		$this->db->from('employee_data');
		$this->db->like('partner_name',$keyword);
		return $this->db->get()->result();
	}

}
