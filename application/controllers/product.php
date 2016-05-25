<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/******			View			******/

	public function index()
	{
		$data['title'] = 'Product';


		$this->load->view('parts/head',$data);
		$this->load->view('product/product_list',$data);
		$this->load->view('parts/footer');
	}


	/******			Form			******/


	public function create()
	{
		$data['title'] = 'สร้างรายการสินค้าใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/product').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/product/create').'">พิมพ์รายงาน</a></li>';

		$this->load->view('parts/head',$data);
		$this->load->view('product/product_form',$data);
		$this->load->view('parts/footer');
	}

	public function data()
	{
		$data['title'] = 'แก้ไขรายการสินค้า';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/product').'">ยกเลิก</a></li>
			<li><a class="button hollow alert" href="'.site_url('/product').'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/product/create').'">พิมพ์รายงาน</a></li>';

		$this->load->view('parts/head');
		$this->load->view('rental/rental_form',$data);
		$this->load->view('parts/footer');	
	}
	/******			Database			******/

	public function add()
	{

	}

	public function edit()
	{

	}
}
