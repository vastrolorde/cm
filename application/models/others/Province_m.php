<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_m extends CI_Model {

	/******			Others			******/
	//partner data
	public function province()
	{
		$this->db->select();
		$this->db->from('province');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Dist($data)
	{
		$this->db->select();
		$this->db->from('Dist');
		$this->db->where('Province_ID',$data);
		$query = $this->db->get();
		return $query->result();
	}

	public function SubDist($data)
	{
		$this->db->select();
		$this->db->from('subdist');
		$this->db->where('Dist_ID',$data);
		$query = $this->db->get();
		return $query->result();
	}

	public function province_get()
	{
		$partner = $this->input->post('pid');

		$this->db->select("*");
		$this->db->where("id",$partner);
		$query = $this->db->get('partner');
		$result = $query->result();

		echo json_encode($result);
	}



}
