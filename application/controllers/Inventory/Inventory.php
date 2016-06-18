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

		$this->load->library('pagination');

		$config['base_url'] = site_url().'/Inventory';
		$config['total_rows'] = $this->Inventory_m->countAll();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;

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

		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3)) ;
		}else{
			$page = 0;
		}

		$data['title'] = 'รายการเคลื่อนไหวสินค้าคงคลัง';
		$data['result'] = $this->Inventory_m->getAll($config['per_page'],$page);
		$data['pagination'] = $this->pagination->create_links();
		$data['partner'] = $this->partnerSearch();

		$this->load->View('parts/head',$data);
		$this->load->view('Inventory/Inventory_move_list',$data);
		$this->load->View('parts/footer');
	}


	/******			Form			******/

	// public function create()
	// {

	// }

	public function data($id)
	{
		$data['title'] = 'ใบรับ/เบิกสินค้า';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/Inventory/Inventory').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/Inventory/Inventory/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/Inventory/Inventory/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->Inventory_m->get($id);
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';
		$data['partner'] = $this->partnerSearch();

		$this->load->view('parts/head',$data);
		$this->load->view('Inventory/Inventory_move_form',$data);
		$this->load->view('parts/footer');
		$this->load->View('scripts/inventory_script');

	}
	/******			Database			******/

	public function add()
	{
		$id = $this->input->post('id');

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');

		// --------------- Validation --------------- //
		$this->form_validation->set_rules('id','เลขที่เอกสาร','required');
		$this->form_validation->set_rules('partner_id', 'ลูกค้า','required');
		$this->form_validation->set_rules('invent_move_Date', 'วันที่ลูกค้ามารับของ','required');

		if ($this->form_validation->run() == TRUE){

			$data = array(
				'id'                     =>	$id,
				'partner_id'             =>	$this->input->post('partner_id'),
				'invent_move_createDate' =>	$this->input->post('invent_move_createDate'),
				'invent_move_Date'       =>	$this->input->post('invent_move_Date'),
				'invent_move_type'       =>	$this->input->post('invent_move_type'),
				'invent_move_status'     =>	$this->input->post('invent_move_status')
			);

			$this->Inventory_m->create($data);
			

			redirect('/Inventory/Inventory/data/'.$id);
		}else{

			$this->data($id);
		}
	}

	public function edit()
	{

	}

	/******			Others			******/
	//Autocomplete Partner Lookup
	public function partnerSearch()
	{
		$keyword = $this->input->post('search');
		$result = $this->Inventory_m->lookup($keyword);

		return $result;
	}

}
