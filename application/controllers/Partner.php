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
		$data['title'] = 'partner';
		$data['result'] = $this->partner_m->getAll();


		$this->load->view('parts/head',$data);
		$this->load->view('partner/partner_list',$data);
		$this->load->view('parts/footer');
		$this->load->view('scripts/partner_script');
	}



	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้าง Partner ใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/partner').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/partner/create').'">พิมพ์รายงาน</a></li>';
		$data['bank'] = $this->partner_m->bank();

		$this->load->view('parts/head',$data);
		$this->load->view('partner/partner_form',$data);
		$this->load->view('parts/footer');	
		$this->load->view('scripts/partner_script');
	}

	public function data($id)
	{
		$data['title'] = 'แก้ไข Partner';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/partner').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/partner/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/partner/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->partner_m->get($id);
		$data['bank'] = $this->partner_m->bank();

		$this->load->view('parts/head');
		$this->load->view('partner/partner_form',$data);
		$this->load->view('parts/footer');	
		$this->load->view('scripts/partner_script');
	}


	/******			Database			******/

	public function add()
	{
		// --------------- partner ---------------

		$data = array(
		'id'                =>	$this->input->post('id'),
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
		'Acc_no'            =>	$this->input->post('Acc_no'),
		'Acc_type'          =>	$this->input->post('Acc_type'),
		'Acc_branch'        =>	$this->input->post('Acc_branch'),
		'Sector'            =>	$this->input->post('Sector'),
		'partner_contactor' =>	json_encode($this->input->post('partner_contactor'))
		);

		$this->partner_m->create($data);
		

		redirect('/partner');

	}

	public function edit($id)
	{

		// --------------- partner ---------------

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
		'Acc_no'            =>	$this->input->post('Acc_no'),
		'Acc_type'          =>	$this->input->post('Acc_type'),
		'Acc_branch'        =>	$this->input->post('Acc_branch'),
		'Sector'            =>	$this->input->post('Sector'),
		'partner_contactor' =>	json_encode($this->input->post('partner_contactor'))
		);


		$this->partner_m->update($data,$id);
		redirect('/partner');
	}

	public function delete($id){
		$this->partner_m->delete($id);

		redirect('/partner');
	}

	public function lookup(){
		$keyword = $this->input->post('search');
		$query = $this->partner_m->lookup($keyword);

		echo json_encode($query);

	}
}
