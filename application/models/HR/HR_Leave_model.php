<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HR_Leave_model extends CI_Model {

	public function getAll(){
		$this->db->select("*");
		$this->db->where('emp_status', 'บรรจุแล้ว');
		$this->db->or_where('emp_status', 'ทดลองงาน');
		$query = $this->db->get('hr_employee_data');
		return $result = $query->result();
	}

	public function get($id){
		$this->db->select();
		$this->db->from('hr_leave');
		$this->db->where("emp_id",$id);
		$this->db->order_by('lve_date', 'ASC');
		$query = $this->db->get();
		return $result = $query->result_array();
	}

	public function create($data){
		$this->db->insert('hr_leave',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('hr_leave',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('hr_leave');
	}

	// Other

	public function sumLeave(){
		$this->db->select('lve.emp_id,lve.lve_type,emp.id,emp.emp_fname,emp.emp_lname');
		$this->db->select_sum('lve.lve_diff');
		$this->db->from('hr_leave as lve');
		$this->db->join('hr_employee_data as emp','lve.emp_id = emp.id');
		$this->db->where('emp.emp_status','บรรจุแล้ว');
		$this->db->or_where('emp.emp_status','ทดลองงาน');
		$this->db->group_by('lve.emp_id');
		$this->db->group_by('lve.lve_type');
		$query = $this->db->get();
		return $result = $query->result_array();
	}

}
