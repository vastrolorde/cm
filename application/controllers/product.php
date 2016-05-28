<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('product/product_model','product_m');
		$this->load->helper('string');
	}

	/******			View			******/

	public function index()
	{
		$data['title'] = 'Product';
		$data['result'] = $this->product_m->getAll();


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
		$this->load->view('scripts/product_script');
	}

	public function data($id)
	{
		$data['title'] = 'แก้ไขรายการสินค้า';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/product').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/product').'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/product/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->product_m->get($id,'product');
		$data['data2'] = $this->product_m->get($id,'product_attr_transaction');

		$this->load->view('parts/head');
		$this->load->view('product/product_form',$data);
		$this->load->view('parts/footer');	
		$this->load->view('scripts/product_script');
	}
	/******			Database			******/

	public function add()
	{

		$data = array(
		'product_id'             =>	$this->input->post('product_id'),
		'product_unit'           =>	$this->input->post('product_unit'),
		'product_name'           =>	$this->input->post('product_name'),
		'product_weight'         =>	$this->input->post('product_weight'),
		'product_type'           =>	$this->input->post('product_type'),
		'product_Desc'           =>	$this->input->post('product_Desc'),
		'product_cost'           =>	$this->input->post('product_cost'),
		'product_1stSalePrice'   =>	$this->input->post('product_1stSalePrice'),
		'product_2ndSalePrice'   =>	$this->input->post('product_2ndSalePrice'),
		'product_d_RentalPrice'  =>	$this->input->post('product_d_RentalPrice'),
		'product_GuaranteePrice' =>	$this->input->post('product_GuaranteePrice'),
		);


		$id               = $this->input->post('product_AttrID');
		$product_id       = $this->input->post('product_id');
		$product_AttrName = $this->input->post('product_AttrName');
		$product_AttrDesc = $this->input->post('product_AttrDesc');

		$data2 = '';

		for($i=0; $i<count($product_AttrName);$i++){
			$data2[] = array(
				'id'               =>	$id[$i],
				'product_id'       =>	$product_id,
				'product_AttrName' =>	$product_AttrName[$i],
				'product_AttrDesc' =>	$product_AttrDesc[$i]
			);
		}
		

		$this->product_m->create($data);
		$this->product_m->create_batch($data2);

		redirect('/product');

	}

	public function edit()
	{

	}
}
