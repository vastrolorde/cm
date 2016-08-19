<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db->save_queries = false; // ADD THIS LINE TO SOLVE ISSUE
		$this->load->model('product/product_model','product_m');
		$this->load->helper('string');
	}

	/******			View			******/

	public function index()
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{

			$data['title'] = 'Product';
			$data['result'] = $this->product_m->getAll();

			$this->load->view('parts/head',$data);
			$this->load->view('product/product_list',$data);
			$this->load->view('parts/footer');
			$this->load->view('scripts/product_script');
		}
	}


	/******			Form			******/


	public function create()
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
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
	}

	public function data($id)
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$data['title'] = 'แก้ไขรายการสินค้า';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('/product').'">ยกเลิก</a></li>
				<li><a class="button hollow alert delitem" href="'.site_url('/product/delete').'/'.$id.'">ลบ</a></li>
				<li><a class="button hollow" href="'.site_url('/product/create').'">พิมพ์รายงาน</a></li>';
			$data['data'] = $this->product_m->get($id);

			$this->load->view('parts/head');
			$this->load->view('product/product_form',$data);
			$this->load->view('parts/footer');	
			$this->load->view('scripts/product_script');
		}
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
		'product_stock'          =>	$this->input->post('product_stock'),
		'product_safety'         =>	$this->input->post('product_safety'),
		'product_stock_date'     =>	$this->input->post('product_stock_date'),
		'product_cost'           =>	$this->input->post('product_cost'),
		'product_1stSalePrice'   =>	$this->input->post('product_1stSalePrice'),
		'product_2ndSalePrice'   =>	$this->input->post('product_2ndSalePrice'),
		'product_d_RentalPrice'  =>	$this->input->post('product_d_RentalPrice'),
		'product_GuaranteePrice' =>	$this->input->post('product_GuaranteePrice'),
		'product_Attr'           =>	json_encode($this->input->post('product_Attr'))
		);

		$this->product_m->create($data);

		redirect('/product');

	}

	public function edit($id)
	{
		$data = array(
		'product_unit'           =>	$this->input->post('product_unit'),
		'product_family'         =>	$this->input->post('product_family'),
		'product_name'           =>	$this->input->post('product_name'),
		'product_weight'         =>	$this->input->post('product_weight'),
		'product_type'           =>	$this->input->post('product_type'),
		'product_Desc'           =>	$this->input->post('product_Desc'),
		'product_stock'          =>	$this->input->post('product_stock'),
		'product_safety'         =>	$this->input->post('product_safety'),
		'product_stock_date'     =>	$this->input->post('product_stock_date'),
		'product_cost'           =>	$this->input->post('product_cost'),
		'product_1stSalePrice'   =>	$this->input->post('product_1stSalePrice'),
		'product_2ndSalePrice'   =>	$this->input->post('product_2ndSalePrice'),
		'product_d_RentalPrice'  =>	$this->input->post('product_d_RentalPrice'),
		'product_GuaranteePrice' =>	$this->input->post('product_GuaranteePrice'),
		'product_Attr'           =>	json_encode($this->input->post('product_Attr'))
		);

		$this->product_m->update($data,$id);
		redirect('/product');
	}

	public function delete($id){
		$this->product_m->delete($id);

		redirect('/product');
	}


	public function lookup(){
		$keyword = $this->input->post('search');
		$query = $this->product_m->lookup($keyword);

		echo json_encode($query);

	}






}
