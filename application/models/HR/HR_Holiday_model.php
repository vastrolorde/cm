<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HR_Holiday_model extends CI_Model {

	public function getAll(){
		$this->db->select();
		$this->db->select("DATE_FORMAT(hol_date,'%d/%m/%Y') as hol_date");
		$this->db->from('hr_holiday');
		$this->db->order_by('hr_holiday.hol_date', 'ASC');
		$query = $this->db->get();

		return $result = $query->result();
	}

	public function get($id){
		$this->db->select();
		$this->db->select("DATE_FORMAT(hol_date,'%d/%m/%Y') as hol_date");
		$this->db->where("id",$id);
		$query = $this->db->get('hr_holiday');
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('hr_holiday',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('hr_holiday',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('hr_holiday');
	}

	// Other

	public function countAll(){
		$result = $this->db->count_all('hr_holiday');
		return $result;
	}

}
