<?php

/* ทดสอบตัวอย่างแปลงค่าวันที่ ก่อนนำเข้า database */


defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		echo form_open('Test/add');
		echo form_input('date');
		echo '<button class="button" type="submit">Submit</button>';

		$this->db->select();
		$this->db->from('test');
		$query = $this->db->get()->result();

		foreach($query as $row){
			$date = new DateTime($row->date);
			echo '<p>'.$date->format('d/m/Y').'</p>';
		}
	}

	public function add()
	{
		$date = str_replace('/', '-', $this->input->post('date'));

		$data = array( 'date' => date('Y-m-d', strtotime($date)) );

		$this->db->insert('test',$data);

		redirect('Test');

	}

}
