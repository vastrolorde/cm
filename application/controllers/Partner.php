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
		$this->load->model('others/Province_m','Province'); //Province Plugin


		$data['title'] = 'สร้าง Partner ใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/partner').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/partner/create').'">พิมพ์รายงาน</a></li>';
		$data['Province_all'] = $this->Province->province(); //Province Plugin
		$data['bank'] = $this->partner_m->bank();
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('partner/partner_form',$data);
		$this->load->view('parts/footer');	
		$this->load->view('scripts/partner_script');
		
	}

	public function data($id)
	{
		$this->load->model('others/Province_m','Province'); //Province Plugin

		$data['title'] = 'แก้ไข Partner';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/partner').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/partner/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/partner/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->partner_m->get($id);
		$data['Province_all'] = $this->Province->province(); //Province Plugin
		$data['bank'] = $this->partner_m->bank();
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('partner/partner_form',$data);
		$this->load->view('parts/footer');	
		$this->load->view('scripts/partner_script');
	}


	/******			Database			******/

	public function add()
	{
		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		$this->form_validation->set_message('valid_email','<code style="color:red;">กรุณาตรวจสอบรูปแบบของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('exact_length','<code style="color:red;">คุณต้องกรอกข้อมูล 5 ตัวอกษร กรุณาตรวจสอบจำนวนตัวอักษรของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('regex_match','<code style="color:red;">กรุณาตรวจสอบรูปแบบตัวของ %s อีกครั้ง</code>');
		
		// --------------- Validation --------------- //
		$this->form_validation->set_rules('id','Partner id','required');
		$this->form_validation->set_rules('partner_name','ชื่อ partner','required');
		$this->form_validation->set_rules('Postal','รหัสไปรษณีย์','exact_length[5]|integer');
		$this->form_validation->set_rules('tel','เบอร์โทรศัพท์','regex_match[/^(?([0-9]{3}))*-([0-9]{3})*-([0-9]{4})$/]');
		$this->form_validation->set_rules('Fax','Fax','integer','regex_match[/^[0-9().-]+$/]');
		$this->form_validation->set_rules('email','email','valid_email');

		if ($this->form_validation->run() == TRUE)
                {
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
				}else{
					$this->create();
				}

	}

	public function edit($id)
	{

		// --------------- Setting --------------- //
		$this->form_validation->set_message('required','<code style="color:red;">คุณไม่ได้กรอก %s</code>');
		$this->form_validation->set_message('integer','<code style="color:red;">ช่อง %s ต้องเป็นตัวเลข</code>');
		$this->form_validation->set_message('valid_email','<code style="color:red;">กรุณาตรวจสอบรูปแบบของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('exact_length','<code style="color:red;">คุณต้องกรอกข้อมูล 5 ตัวอกษร กรุณาตรวจสอบจำนวนตัวอักษรของ %s อีกครั้ง</code>');
		$this->form_validation->set_message('regex_match','<code style="color:red;">กรุณาตรวจสอบรูปแบบตัวของ %s อีกครั้ง</code>');
		
		// --------------- Validation --------------- //
		$this->form_validation->set_rules('partner_name','ชื่อ partner','required');
		$this->form_validation->set_rules('Postal','รหัสไปรษณีย์','exact_length[5]|integer');
		$this->form_validation->set_rules('tel','เบอร์โทรศัพท์','regex_match[/^[0-9().-]+$/]');
		$this->form_validation->set_rules('Fax','Fax','integer','regex_match[/^[0-9().-]+$/]');
		$this->form_validation->set_rules('email','email','valid_email');

		if ($this->form_validation->run() == TRUE)
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
					'partner_desc'            =>	$this->input->post('partner_desc')
					);


					$this->partner_m->update($data,$id);
					redirect('/partner');
				}else{
					$this->data($this->input->post('id'));

				}
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
