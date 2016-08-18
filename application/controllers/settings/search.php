<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Inventory/Inventory_m','Inventory_m');
		$this->load->library('pdf');
	}

	/******			Others			******/
	//lookup ref data
	public function lookup()
	{
		$search = $this->input->post('search');
		$this->db->select('id,partner_name');
		$this->db->from('partner');
		$this->db->like('id',$search);
		$result = $this->db->get()->result();
		echo json_encode($result);
	}

}
