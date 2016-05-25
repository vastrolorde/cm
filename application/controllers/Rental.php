<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {

	/******			View			******/

	public function index()
	{
		$data['title'] = 'Rental';


		$this->load->view('parts/head',$data);
		$this->load->view('rental/rental_list',$data);
		$this->load->view('parts/footer');
	}


	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างรายการเช่าใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/rental').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/rental/create').'">พิมพ์รายงาน</a></li>';

		$this->load->view('parts/head',$data);
		$this->load->view('rental/rental_form',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/rental_script');
	}

	public function data()
	{
		$data['title'] = 'แก้ไขรายการเช่า';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/rental').'">ยกเลิก</a></li>
			<li><a class="button hollow alert" href="'.site_url('/rental').'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/rental/create').'">พิมพ์รายงาน</a></li>';

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
