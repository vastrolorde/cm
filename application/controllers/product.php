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

		$this->load->library('pagination');

		$config['base_url'] = site_url().'/Product';
		$config['total_rows'] = $this->product_m->countAll();
		$config['per_page'] = 15;
		$config['uri_segment'] = 2;

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';		

		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="current">';
		$config['cur_tag_close'] = '</li>';

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$this->pagination->initialize($config);

		if($this->uri->segment(2)){
			$page = ($this->uri->segment(2)) ;
		}else{
			$page = 0;
		}

		$data['title'] = 'Product';
		$data['result'] = $this->product_m->getAll($config['per_page'],$page);
		$data['pagination'] = $this->pagination->create_links();


		$this->load->view('parts/head',$data);
		$this->load->view('product/product_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/product_script');
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
			<li><a class="button hollow alert delitem" href="'.site_url('/product/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/product/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->product_m->get($id);

		$this->load->view('parts/head');
		$this->load->view('product/product_form',$data);
		$this->load->view('parts/footer');	
		$this->load->view('scripts/product_script');
	}
	/******			Database			******/

	public function add()
	{
		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		
		// --------------- Validation --------------- //
		$this->form_validation->set_rules('product_id','product code','required');
		$this->form_validation->set_rules('product_unit','หน่วยนับ','required');
		$this->form_validation->set_rules('product_name','ชื่อสินค้า','required');
		$this->form_validation->set_rules('product_weight','น้ำหนักต่อชิ้น','integer');

		if ($this->form_validation->run() == TRUE)
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
					'product_cost'           =>	$this->input->post('product_cost'),
					'product_1stSalePrice'   =>	$this->input->post('product_1stSalePrice'),
					'product_2ndSalePrice'   =>	$this->input->post('product_2ndSalePrice'),
					'product_d_RentalPrice'  =>	$this->input->post('product_d_RentalPrice'),
					'product_GuaranteePrice' =>	$this->input->post('product_GuaranteePrice'),
					'product_Attr'           =>	json_encode($this->input->post('product_Attr'))
					);

					$this->product_m->create($data);

					redirect('/product');
				}else{
					$this->create();
				}

	}

	public function edit($id)
	{
		
		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		
		// --------------- Validation --------------- //
		$this->form_validation->set_rules('product_unit','หน่วยนับ','required');
		$this->form_validation->set_rules('product_name','ชื่อสินค้า','required');
		$this->form_validation->set_rules('product_weight','น้ำหนักต่อชิ้น','integer');

		if ($this->form_validation->run() == TRUE)
                {
					$data = array(
					'product_unit'           =>	$this->input->post('product_unit'),
					'product_name'           =>	$this->input->post('product_name'),
					'product_weight'         =>	$this->input->post('product_weight'),
					'product_type'           =>	$this->input->post('product_type'),
					'product_Desc'           =>	$this->input->post('product_Desc'),
					'product_stock'          =>	$this->input->post('product_stock'),
					'product_safety'         =>	$this->input->post('product_safety'),
					'product_cost'           =>	$this->input->post('product_cost'),
					'product_1stSalePrice'   =>	$this->input->post('product_1stSalePrice'),
					'product_2ndSalePrice'   =>	$this->input->post('product_2ndSalePrice'),
					'product_d_RentalPrice'  =>	$this->input->post('product_d_RentalPrice'),
					'product_GuaranteePrice' =>	$this->input->post('product_GuaranteePrice'),
					'product_Attr'           =>	json_encode($this->input->post('product_Attr'))
					);

					$this->product_m->update($data,$id);
					redirect('/product');

				}else{
					$this->data($id);
				}
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
