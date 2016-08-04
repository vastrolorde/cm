<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HR_Att_model extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$this->db->from("hr_att as att");
		$this->db->join("hr_employee_data as emp","att.emp_id = emp.id");
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function get($id){
		$this->db->select();
		$this->db->from('hr_att');
		$this->db->where("emp_id",$id);
		$this->db->order_by('lve_date', 'ASC');
		$query = $this->db->get();
		return $result = $query->result_array();
	}

	public function create($data){
		$this->db->insert('hr_att',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('hr_att',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('hr_att');
	}

	// Other

}
