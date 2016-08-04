<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HR_Emp_model extends CI_Model {

	public function getAll(){
		/*
		"SELECT hr_employee_data.id,hr_employee_data.emp_prefix,hr_employee_data.emp_fname,hr_employee_data.emp_lname,hr_employee_data.emp_position_now,hr_employee_data.emp_dept_now,
hr_employee_data.emp_status,hr_position.id, hr_position.position_name FROM hr_employee_data INNER JOIN hr_position ON hr_employee_data.emp_position_now = hr_position.id"
*/
		$this->db->select('emp.id,emp.emp_prefix,emp.emp_fname,emp.emp_lname,emp.emp_position_now,emp.emp_dept_now,
		emp.emp_status,pos.position_name,dept.dept_name');
		$this->db->from('hr_employee_data as emp');
		$this->db->join('hr_position as pos','emp.emp_position_now = pos.id');
		$this->db->join('hr_dept as dept','emp.emp_dept_now = dept.id');
		$this->db->order_by('emp.id', 'ASC');
		$this->db->where('emp.emp_status', 'บรรจุแล้ว');
		$this->db->or_where('emp.emp_status', 'ทดลองงาน');
		$query = $this->db->get();
		
		return $result = $query->result();
	}

	public function get($id){
		$this->db->select("*");
		$this->db->where("id",$id);
		$query = $this->db->get('hr_employee_data');
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('hr_employee_data',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('hr_employee_data',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('hr_employee_data');
	}

	// Other

	public function countAll(){
		$result = $this->db->count_all('hr_employee_data');
		return $result;
	}

	public function lookup($keyword){
		$this->db->select('partner_name');
		$this->db->from('hr_employee_data');
		$this->db->like('partner_name',$keyword);
		return $this->db->get()->result();
	}

	public function getDept(){
		$this->db->select();
		$query = $this->db->get('hr_dept');
		return $result = $query->result_array();
	}

	public function getPosition(){
		$this->db->select();
		$query = $this->db->get('hr_position');
		return $result = $query->result_array();
	}

}
