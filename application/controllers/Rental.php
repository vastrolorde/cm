<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {

	/******			View			******/

	public function index()
	{
		$data['title'] = 'สร้างผู้เช่าใหม่';


		$this->load->view('parts/head',$data);
		$this->load->view('rental/rental_form',$data);
		$this->load->view('parts/footer');	
}


	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างรายการเช่าใหม่';
		$data['execute'] = '
              <a class="btn btn-default" href="#" role="button">บันทึก</a>
              <a class="btn btn-default" href="#" role="button">ยกเลิก</a>
              <a class="btn btn-default" href="#" role="button">พิมพ์</a>';

		$this->load->view('parts/head',$data);
		$this->load->view('rental/rental_form',$data);
		$this->load->view('parts/footer');	
	}

	public function data()
	{
		$data['title'] = 'แก้ไขรายการเช่า';
		$data['execute'] = '
              <a class="btn btn-default" href="#" role="button">บันทึก</a>
              <a class="btn btn-default" href="#" role="button">ยกเลิก</a>
              <a class="btn btn-default" href="#" role="button">ลบ</a>
              <a class="btn btn-default" href="#" role="button">พิมพ์</a>';

		$this->load->view('parts/head');
		$this->load->view('rental/rental_form',$data);
		$this->load->view('parts/footer');	
	}

	/******			Database			******/

	public function add()
	{
		$this->load->view('welcome_message');
	}

	public function edit()
	{
		$this->load->view('welcome_message');
	}
}
