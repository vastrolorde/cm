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

		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$data['title'] = 'เบิก/รับสินค้าคงคลัง';
			$data['result'] = $this->Inventory_m->getAll();

			$this->load->View('parts/head',$data);
			$this->load->view('Inventory/Inventory_move_list',$data);
			$this->load->View('parts/footer');
		}
	}

	public function inv_flow()
	{

		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$data['title'] = 'รายการเคลื่อนไหวสินค้าคงคลัง';
			$data['product'] = $this->product_m->get_flow();

			$this->load->View('parts/head',$data);
			$this->load->view('Inventory/inventory_flow',$data);
			$this->load->View('parts/footer');
			$this->load->View('scripts/inventory_script');
		}
	}

	/******			Form			******/

	public function data($id)
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{

			$data['title'] = 'ใบรับ/เบิกสินค้า';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('/Inventory/Inventory').'">ยกเลิก</a></li>
				<li><a class="button hollow alert delitem" href="'.site_url('/Inventory/Inventory/delete').'/'.$id.'">ลบ</a></li>
				<li><a class="button hollow" href="'.site_url('/Inventory/Inventory/invent_move_pdf').'/'.$id.'">พิมพ์รายงาน</a></li>';
			
			$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';
			
			//ดึงข้อมูลรายการใบเบิก
			$data['data'] = $this->Inventory_m->get($id);

			//ดึงข้อมูล Warehouse
			$data['warehouse'] = $this->warehouse();
			$data['product'] = $this->product_m->product_all();

			$this->load->view('parts/head',$data);
			$this->load->view('Inventory/Inventory_move_form',$data);
			$this->load->view('parts/footer');
			$this->load->View('scripts/inventory_script');
		}
	}

	/******			Database			******/

	public function add()
	{
		$id = $this->input->post('id');

		$date = str_replace('/', '-', $this->input->post('invent_move_Date'));

			$data = array(
				'id'                 =>	$id,
				'refdoc_id'         =>	$this->input->post('refdoc_id'),
				'create_date'        =>	$this->input->post('create_date'),
				'invent_move_Date'   =>	date('Y-m-d', strtotime($date)),
				'invent_move_type'   =>	$this->input->post('invent_move_type'),
				'invent_move_status' =>	$this->input->post('invent_move_status')
			);

		$this->Inventory_m->create($data);
		redirect('/Inventory/Inventory/data/'.$id);
	}

	public function edit($id)
	{
			$data = array(
				'refdoc_id'         =>	$this->input->post('refdoc_id'),
				'update_date'        =>	$this->input->post('update_date'),
				'invent_move_status' =>	$this->input->post('invent_move_status'),
				'invent_move_wh'     =>	$this->input->post('invent_move_wh')
			);

			$data_tr = array(
				'invent_move_Date' =>	$this->input->post('invent_move_Date'),
				'status' =>	$this->input->post('invent_move_status'),
			);

			$this->Inventory_m->update($data,$id);
			
			$this->Inventory_m->update_transaction_status($data_tr,$id);
			

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
		$date = str_replace('/', '-', $this->input->post('invent_move_Date'));

		$data = array(
			'inventory_move_id' =>	$this->input->post('inventory_move_id'),
			'invent_move_Date'   =>	date('Y-m-d', strtotime($date)),
			'product_id'        =>	$this->input->post('product_id'),
			'amount'            =>	$this->input->post('amount'),
			'type'            =>	$this->input->post('type'),
			'status'            =>	$this->input->post('status')
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
