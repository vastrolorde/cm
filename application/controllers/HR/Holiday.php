<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday extends CI_Controller {

		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('HR/HR_Holiday_model','hr_Holiday_m');
		$this->load->library('pdf'); // Load library
	}

	/******			View			******/

	public function index()
	{


		if(!$this->ion_auth->logged_in()){
			$_SESSION['error_msg'] = 'คุณยังไม่ได้รับสิทธิ์ในส่วนนี้';
			$this->session->mark_as_flash('error_msg');

			redirect('/login');
		}else{

		$data['title'] = 'วันหยุดประจำปี';
		$data['result'] = $this->hr_Holiday_m->getAll();
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Holiday_list',$data);
		$this->load->view('parts/footer');
		}
	}

	/******			Form			******/

	public function create()
	{
		$data['title'] = 'สร้างตำแหน่งใหม่';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Holiday').'">ยกเลิก</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Holiday/create').'">พิมพ์รายงาน</a></li>';
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Hol_form',$data);
		$this->load->view('parts/footer');
	}

	public function data($id)
	{
		$data['title'] = 'แก้ไขตำแหน่ง';
		$data['execute'] = 
			'<li><input class="button hollow success" type="submit"></li>
			<li><a class="button hollow warning" href="'.site_url('/HR/Holiday').'">ยกเลิก</a></li>
			<li><a class="button hollow alert delitem" href="'.site_url('/HR/Holiday/delete').'/'.$id.'">ลบ</a></li>
			<li><a class="button hollow" href="'.site_url('/HR/Holiday/create').'">พิมพ์รายงาน</a></li>';
		$data['data'] = $this->hr_Holiday_m->get($id);
		$data['mask'] = '<script language="javascript" src="'.asset_url().'js/js_mask_helper.js'.'""></script>';

		$this->load->view('parts/head',$data);
		$this->load->view('HR/HR_Hol_form',$data);
		$this->load->view('parts/footer');
	}


	/******			Database			******/

	public function add()
	{

		$data = array(
			'hol_date' => $this->input->post('hol_date'),
			'hol_name' => $this->input->post('hol_name'),
			'hol_remark' => $this->input->post('hol_remark')
		);

		$this->hr_Holiday_m->create($data);
		

		redirect('/HR/Holiday/');
	}

	public function edit($id)
	{

		// --------------- Setting --------------- //
		$data = array(
			'hol_date' => $this->input->post('hol_date'),
			'hol_name' => $this->input->post('hol_name'),
			'hol_remark' => $this->input->post('hol_remark')
		);

			$this->hr_Holiday_m->update($data,$id);
			

			redirect('/HR/Holiday/');
	}

	public function delete($id){
		$this->hr_Holiday_m->delete($id);

		redirect('/HR/Holiday/');
	}

	public function lookup_manager(){
		$keyword = $this->input->post('lookup');
		$this->db->SELECT('*');
		$this->db->FROM('hr_Holiday');
		$this->db->LIKE('Holiday_name',$keyword);
		$query = $this->db->get()->result();

		echo json_encode($query);
	}

}
