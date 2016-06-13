<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Inventory/Inventory_m','Inventory_m');
	}

	/******			View			******/

	public function index()
	{
		$data['title'] = 'รายการเคลื่อนไหวสินค้าคงคลัง';

		$this->load->View('parts/head',$data);
		$this->load->view('Inventory/Inventory_list');
		$this->load->View('parts/footer');
	}


	/******			Form			******/

	public function create()
	{

	}

	public function data()
	{

	}
	/******			Database			******/

	public function add()
	{

	}

	public function edit()
	{

	}
}
