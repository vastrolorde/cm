<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {

		public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->model('partner/partner_model','partner_m');
	}

	/******			View			******/

	public function index()
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{

			$data['title'] = 'partner';
			$data['result'] = $this->partner_m->getAll();

			$this->load->view('parts/head',$data);
			$this->load->view('partner/partner_list',$data);
			$this->load->view('parts/footer');
			$this->load->view('scripts/partner_script');
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

			$this->load->model('others/Province_m','Province'); //Province Plugin
			$data['title'] = 'สร้าง Partner ใหม่';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('/partner').'">ยกเลิก</a></li>
				<li><a class="button hollow" href="'.site_url('/partner/create').'">พิมพ์รายงาน</a></li>';
			$data['Province_all'] = $this->Province->province(); //Province Plugin
			$data['bank'] = $this->partner_m->bank();
			$data['indy'] = $this->partner_m->indy_all();
			$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

			$this->load->view('parts/head',$data);
			$this->load->view('partner/partner_form',$data);
			$this->load->view('parts/footer');	
			$this->load->view('scripts/partner_script');
		}
		
	}

	public function data($id)
	{
		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{
			$this->load->model('others/Province_m','Province'); //Province Plugin

			$data['title'] = 'แก้ไข Partner';
			$data['execute'] = 
				'<li><input class="button hollow success" type="submit"></li>
				<li><a class="button hollow warning" href="'.site_url('/partner').'">ยกเลิก</a></li>
				<li><a class="button hollow alert delitem" href="'.site_url('/partner/delete').'/'.$id.'">ลบ</a></li>
				<li><a class="button hollow" href="'.site_url('/partner/create').'">พิมพ์รายงาน</a></li>';
			$data['Province_all'] = $this->Province->province(); //Province Plugin
			$data['data'] = $this->partner_m->get($id);
			$data['bank'] = $this->partner_m->bank();
			$data['indy'] = $this->partner_m->indy_all();
			$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

			$this->load->view('parts/head',$data);
			$this->load->view('partner/partner_form',$data);
			$this->load->view('parts/footer');	
			$this->load->view('scripts/partner_script');
		}
	}


	/******			Database			******/

	public function add()
	{

		// Generate ID

		//Get Type Code
		$type = $this->input->post('Type');
		$Sector = $this->input->post('Sector');

		//Get Sector Code
		$this->db->select('code');
		$this->db->where('subsector',$Sector);
		$this->db->from('partner_industries');
		$sector_code = $this->db->get()->result_array();

		//run Code
		$this->db->select();
		$this->db->where('Sector',$Sector);
		$this->db->from('partner');
		$num = sprintf("%05d",$this->db->get()->num_rows()+1);

		if(in_array('supplier', $type)){

			$id = 'SP'.'-'.$sector_code[0]['code'].'-'.$num;
		
		}elseif (in_array('customer', $type)) {

			$id = 'CS'.'-'.$sector_code[0]['code'].'-'.$num;
		
		}elseif (in_array('customer', $type) && in_array('supplier', $type)) {

			$id = 'PT'.'-'.$sector_code[0]['code'].'-'.$num;
		
		}

		$data = array(
		'id'                =>	$id,
		'taxID'             =>	$this->input->post('taxID'),
		'partner_name'      =>	$this->input->post('partner_name'),
		'tel'               =>	$this->input->post('tel'),
		'Fax'               =>	$this->input->post('Fax'),
		'email'             =>	$this->input->post('email'),
		'add1'              =>	$this->input->post('add1'),
		'add2'              =>	$this->input->post('add2'),
		'SubDist'           =>	$this->input->post('SubDist'),
		'Dist'              =>	$this->input->post('Dist'),
		'Province'          =>	$this->input->post('Province'),
		'Postal'            =>	$this->input->post('Postal'),
		'Type'              =>	json_encode($this->input->post('Type')),
		'Bank'              =>	$this->input->post('Bank'),
		'Acc_name'          =>	$this->input->post('Acc_name'),
		'Acc_no'            =>	$this->input->post('Acc_no'),
		'Acc_type'          =>	$this->input->post('Acc_type'),
		'Acc_branch'        =>	$this->input->post('Acc_branch'),
		'Sector'            =>	$this->input->post('Sector'),
		'partner_contactor' =>	json_encode($this->input->post('partner_contactor')),
		'partner_desc'      =>	$this->input->post('partner_desc')
		);

		$this->partner_m->create($data);
		

		redirect('/partner');
	}

	public function edit($id)
	{
		$data = array(
		'taxID'             =>	$this->input->post('taxID'),
		'partner_name'      =>	$this->input->post('partner_name'),
		'tel'               =>	$this->input->post('tel'),
		'Fax'               =>	$this->input->post('Fax'),
		'email'             =>	$this->input->post('email'),
		'add1'              =>	$this->input->post('add1'),
		'add2'              =>	$this->input->post('add2'),
		'SubDist'           =>	$this->input->post('SubDist'),
		'Dist'              =>	$this->input->post('Dist'),
		'Province'          =>	$this->input->post('Province'),
		'Postal'            =>	$this->input->post('Postal'),
		'Type'              =>	json_encode($this->input->post('Type')),
		'Bank'              =>	$this->input->post('Bank'),
		'Acc_name'          =>	$this->input->post('Acc_name'),
		'Acc_no'            =>	$this->input->post('Acc_no'),
		'Acc_type'          =>	$this->input->post('Acc_type'),
		'Acc_branch'        =>	$this->input->post('Acc_branch'),
		'Sector'            =>	$this->input->post('Sector'),
		'partner_contactor' =>	json_encode($this->input->post('partner_contactor')),
		'partner_desc'      =>	$this->input->post('partner_desc')
		);


		$this->partner_m->update($data,$id);
		redirect('/partner');
	}

	public function delete($id){
		$this->partner_m->delete($id);

		redirect('/partner');
	}

	/******			Others			******/
	//Autocomplete Partner Lookup
	
	public function lookup(){
		$keyword = $this->input->post('search');
		$query = $this->partner_m->lookup($keyword);

		echo json_encode($query);

	}
}
