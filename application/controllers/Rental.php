<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {

		public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('rental/rental_model','rental_m');
		$this->load->model('product/product_model','product_m');
		$this->load->model('partner/partner_model','partner_m');
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
			$data['title'] = 'งานเช่า';
			$data['rental'] = $this->rental_m->getAll();

			$this->load->view('parts/head',$data);
			$this->load->view('rental/rental_list',$data);
			$this->load->view('parts/footer');
			$this->load->view('scripts/rental_script');
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

			$data['title'] = 'สร้างรายการเช่าใหม่';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('/rental').'">ยกเลิก</a></li>';
			$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

			$this->load->view('parts/head',$data);
			$this->load->view('rental/rental_form',$data);
			$this->load->view('parts/footer');
			$this->load->view('scripts/rental_script');
		}
	}

	public function data($id)
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$data['title'] = 'แก้ไขรายการเช่า';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('/rental').'">ยกเลิก</a></li>
				<li><a class="button hollow alert" href="'.site_url('/rental').'">ลบ</a></li>
				<li><a class="button hollow" href="'.site_url('/rental/rental_pdf/'.$id).'">พิมพ์รายงาน</a></li>';
			$data['data'] = $this->rental_m->get($id);
			$data['product'] = $this->product_m->product_all();
			$data['bank'] = $this->partner_m->bank();
			$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

			$this->load->view('parts/head',$data);
			$this->load->view('rental/rental_form',$data);
			$this->load->view('parts/footer');
			$this->load->view('scripts/rental_script');
		}
	}

	/******			Database			******/

	public function add()
	{

				//run Code
		$this->db->select();
		$this->db->from('rental');
		$num = 'RNT-'.date("Y").date("m").sprintf("%05d",$this->db->get()->num_rows()+1);

		$start = date('Y-m-d', strtotime( str_replace('/', '-', $this->input->post('start_contract')) ) );
		$end = date('Y-m-d', strtotime( str_replace('/', '-', $this->input->post('expire_contract')) ) );

		$data = array(
		'id'              =>	$num,
		'start_contract'  =>	$start,
		'expire_contract' =>	$end,
		'duration'        =>	$this->input->post('duration'),
		'partner_id'      =>	'000',
		'Bank'            =>	'000',
		'active'          =>	$this->input->post('active')
		);

		$this->rental_m->create($data);

		redirect('rental/data/'.$num);
	}

	public function edit($id)
	{

		$data = array(
		'start_contract'  =>	date('Y-m-d', strtotime( str_replace('/', '-', $this->input->post('start_contract')) ) ),
		'expire_contract' =>	date('Y-m-d', strtotime( str_replace('/', '-', $this->input->post('expire_contract')) ) ),
		'duration'        =>	$this->input->post('duration'),
		'partner_id'      =>	$this->input->post('partner_id'),
		'discount'        =>	$this->input->post('discount'),
		'daily_rental'    =>	$this->input->post('daily_rental'),
		'total_rental'    =>	$this->input->post('total_rental'),
		'total_guarantee' =>	$this->input->post('total_guarantee'),
		'tranferDate'     =>	date('Y-m-d', strtotime( str_replace('/', '-', $this->input->post('tranferDate')) ) ),
		'guaranteeType'   =>	$this->input->post('guaranteeType'),
		'tranferNote'     =>	$this->input->post('tranferNote'),
		'Acc_no'          =>	$this->input->post('Acc_no'),
		'Bank'            =>	$this->input->post('Bank'),
		'branch'          =>	$this->input->post('branch'),
		'VATType'         =>	$this->input->post('VATType'),
		'VAT'             =>	$this->input->post('VAT'),
		'grandtotal'      =>	$this->input->post('grandtotal')
		);

		$this->rental_m->update($id,$data);

		redirect('rental');
	}

	public function delete($id)
	{
		$this->rental_m->delete($id);
		redirect('rental');
	}

	// Manage Transaction

	public function data_tr(){
		$id = $this->input->get('id');
		$data['rental_tr'] = $this->rental_m->qry_tr($id);
		$this->load->view('rental/rental_table',$data);
	}

	public function add_tr()
	{
		$data = array(
			'rental_id'        =>	$this->input->post('rental_id'),
			'product_id'        =>	$this->input->post('product_id'),
			'amount'            =>	$this->input->post('amount')
		);

		$this->rental_m->add_tr($data);
	}

	public function update_tr()
	{
		$id = $this->input->get('id');
		$data = array(
			'amount'            =>	$this->input->post('amount')
		);
		$this->rental_m->update_tr($id,$data);
	}

	public function del_tr()
	{
		$id = $this->input->get('id');
		$this->rental_m->del_tr($id);
	}

	//PDF
	public function rental_pdf($id)
	{
		//ดึงข้อมูลรายการใบเบิก
		$data['data'] = $this->rental_m->get($id);
		$data['rental_tr'] = $this->rental_m->qry_tr($id);
		$this->load->view('rental/pdf/rental_pdf.php',$data);
	}
}
