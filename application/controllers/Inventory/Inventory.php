<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Inventory/Inventory_m','Inventory_m');
		$this->load->model('product/product_model','product_m');
		$this->load->library('pdf');
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
		$data['partner'] = $this->partner();

		$this->load->View('parts/head',$data);
		$this->load->view('Inventory/Inventory_move_list',$data);
		$this->load->View('parts/footer');
	}


	/******			Form			******/

	public function data($id)
	{
		$data['title'] = 'ใบรับ/เบิกสินค้า';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/Inventory/Inventory').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/Inventory/Inventory/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/Inventory/Inventory/invent_move_pdf').'/'.$id.'">พิมพ์รายงาน</a></li>';
		
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';
		
		//ดึงข้อมูลรายการใบเบิก
		$data['data'] = $this->Inventory_m->get($id);

		//ดึงข้อมูล Partner และ Warehouse
		$data['partner'] = $this->partner();
		$data['warehouse'] = $this->warehouse();


		$data['product'] = $this->product_m->product_all();

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

	public function edit($id)
	{
			$data = array(
				'invent_move_status'     =>	$this->input->post('invent_move_status')
			);

			$data2 = array(
				'inventory_move_id' =>	$this->input->post('inventory_move_id'),
				'product_id'        =>	$this->input->post('product_id'),
				'amount'            =>	$this->input->post('amount')
			);

			$this->Inventory_m->update($data,$id);
			

			redirect('/Inventory/Inventory');
	}

	public function delete($id){
		$this->Inventory_m->delete($id);

		redirect('Inventory/Inventory/');
	}

	// Manage Transaction

	public function data_tr(){
		$id = $this->input->get('id');
		$data['invent_tr'] = $this->Inventory_m->qry_tr($id);
		$this->load->view('Inventory/Inventory_move_table',$data);
	}
	
	public function add_tr()
	{
		$data = array(
			'inventory_move_id' =>	$this->input->post('inventory_move_id'),
			'product_id'        =>	$this->input->post('product_id'),
			'amount'            =>	$this->input->post('amount')
		);

		$this->Inventory_m->add_tr($data);
	}

	public function update_tr()
	{	
		$id = $this->input->get('id');
		$data = array(
			'amount'            =>	$this->input->post('amount')
		);
		$this->Inventory_m->update_tr($id,$data);
	}

	public function del_tr()
	{
		$id = $this->input->get('id');
		$this->Inventory_m->del_tr($id);
	}

	/******			Others			******/
	//partner data
	public function partner()
	{
		$this->load->model('partner/partner_model','partner_m');
		$result = $this->partner_m->partner_all();
		return $result;
	}

	public function partner_get()
	{
		$partner = $this->input->post('pid');

		$this->db->select("*");
		$this->db->where("id",$partner);
		$query = $this->db->get('partner');
		$result = $query->result();

		echo json_encode($result);
	}

	//warehouse data
	public function warehouse()
	{
		$this->load->model('Inventory/Inventory_wh_m','wh_m');
		$result = $this->wh_m->wh_all();
		return $result;
	}

	public function warehouse_get()
	{
		$warehouse = $this->input->post('warehouse');

		$this->db->select("*");
		$this->db->where("id",$warehouse);
		$query = $this->db->get('Inventory_wh');
		$result = $query->result();

		echo json_encode($result);
	}

	//PDF
	public function invent_move_pdf($id)
	{
		//ดึงข้อมูลรายการใบเบิก
		$data['data'] = $this->Inventory_m->get($id);
		$data['invent_tr'] = $this->Inventory_m->qry_tr($id);
		$this->load->view('Inventory/pdf/Inventory_move_pdf',$data);
	}
}
