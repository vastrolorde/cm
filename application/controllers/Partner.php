<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {

	/******			View			******/

	public function index()
	{
		$data['title'] = 'partner';


		$this->load->view('parts/head',$data);
		$this->load->view('partner/partner_list',$data);
		$this->load->view('parts/footer');
	}



	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้าง Partner ใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/partner').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/rental/create').'">พิมพ์รายงาน</a></li>';

		$this->load->view('parts/head',$data);
		$this->load->view('partner/partner_form',$data);
		$this->load->view('parts/footer');	
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
