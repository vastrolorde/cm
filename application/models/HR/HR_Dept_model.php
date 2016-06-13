<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HR_Dept_model extends CI_Model {

	public function getAll($limit,$page){
		$this->db->limit($limit, $page);
		$this->db->select("*");
		$query = $this->db->get("hr_dept");
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
		$query = $this->db->get('hr_dept');
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('hr_dept',$data);
	}

	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('hr_dept',$data);
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('hr_dept');
	}

	// Other

	public function countAll(){
		$result = $this->db->count_all('hr_dept');
		return $result;
	}

	public function lookup($keyword){
		// $this->db->query('SELECT partner_name FROM partner WHERE partner_name LIKE '.$keyword);
		$this->db->select('dept_name');
		$this->db->from('hr_dept');
		$this->db->like('dept_name',$keyword);
		return $this->db->get()->result();
	}

}
